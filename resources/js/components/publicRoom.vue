<template>
    <div class="flex flex-col bg-gray-100 h-[calc(100vh-56px)]">
        <div class="relative flex flex-1 min-h-0">
            <!-- Mobile drawer backdrop -->
            <div v-if="expandCurrent" class="absolute inset-0 z-20 bg-gray-900/50 md:hidden" @click="expandCurrent = false"></div>

            <!-- Sidebar -->
            <aside :class="[expandCurrent ? 'flex' : 'hidden', 'md:flex absolute z-30 md:static inset-y-0 left-0 w-72 md:w-64 lg:w-72 flex-col bg-white border-r border-gray-200 shadow-xl md:shadow-none']">
                <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 flex-shrink-0">
                    <div class="flex items-center">
                        <svg viewBox="0 0 16 16" color="#3b82f6" class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <h1 class="text-lg font-semibold text-gray-800">
                            Current
                            <span v-text="participants.length" class="ml-2 inline-block rounded-full px-2 py-0.5 text-xs bg-blue-100 text-blue-700"></span>
                        </h1>
                    </div>
                    <button type="button" class="md:hidden text-gray-500 hover:text-gray-700" @click="expandCurrent = false" aria-label="Close online list">
                        <svg viewBox="0 0 16 16" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    </button>
                </div>

                <div class="flex-1 min-h-0 overflow-y-auto p-3">
                    <div class="divide-y divide-gray-100">
                        <div v-for="participant in participants" class="flex items-center py-2 px-2 rounded-lg hover:bg-gray-50">
                            <img class="w-9 h-9 rounded-full" :src="participant.user.avatar" alt="avatar">
                            <p class="ml-3 text-sm font-medium text-gray-800 truncate" v-text="participant.user.name"></p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Chat -->
            <div class="flex flex-col flex-1 min-w-0">
                <header class="flex items-center justify-between bg-blue-900 px-4 py-3 shadow flex-shrink-0">
                    <div class="flex items-center min-w-0">
                        <button type="button" class="md:hidden mr-3 text-white hover:text-blue-200" @click="expandCurrent = true" aria-label="Show online list">
                            <svg viewBox="0 0 20 20" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                        </button>
                        <svg viewBox="0 0 16 16" class="w-6 h-6 text-white opacity-60 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"></path>
                        </svg>
                        <h1 class="text-lg font-semibold text-white">Public Room</h1>
                    </div>
                    <div class="flex items-center flex-shrink-0 ml-3">
                        <a href="/home" class="flex items-center text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg px-3 py-1.5 transition">
                            Leave
                            <svg viewBox="0 0 16 16" class="ml-1 w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"></path>
                            </svg>
                        </a>
                    </div>
                </header>

                <div id="room-messages" class="flex-1 min-h-0 overflow-y-auto px-4 py-4 bg-gray-100">
                    <div class="flex flex-col space-y-3">
                        <div v-for="message in messages" :class="currentUser.id != message.user_id ? 'flex justify-start' : 'flex justify-end'">
                            <div class="flex items-end space-x-2 max-w-[85%] md:max-w-[70%]">
                                <img v-if="currentUser.id != message.user_id" class="w-8 h-8 rounded-full flex-shrink-0 mb-1" :src="message.user_avatar" alt="avatar" :title="message.user_name">
                                <div :class="currentUser.id != message.user_id ? 'bg-white border border-gray-200 rounded-2xl rounded-bl-md' : 'bg-blue-600 rounded-2xl rounded-br-md'" class="px-4 py-2 shadow-sm">
                                    <p v-if="currentUser.id != message.user_id" class="text-xs font-medium text-blue-600 mb-0.5" v-text="message.user_name"></p>
                                    <p v-text="message.message" :class="currentUser.id == message.user_id ? 'text-white' : 'text-gray-800'" class="leading-relaxed text-sm break-words"></p>
                                    <span v-text="message.time" :class="currentUser.id == message.user_id ? 'text-blue-100' : 'text-gray-400'" class="text-xs font-normal"></span>
                                </div>
                            </div>
                        </div>
                        <div v-if="activePeer" class="flex justify-start items-center">
                            <img class="w-8 h-8 rounded-full mr-2" :src="activePeer.user.avatar" alt="avatar" :title="activePeer.user.name">
                            <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-4 py-2 shadow-sm flex items-center">
                                <span class="text-xs font-semibold text-gray-600 mr-1" v-text="activePeer.user.name"></span>
                                <span class="text-xs text-gray-500">is typing</span>
                                <span class="flex space-x-0.5 ml-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0s"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0.15s"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0.3s"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="flex items-center bg-white border-t border-gray-200 px-4 py-3 flex-shrink-0">
                    <input v-model="newMessage" @keyup.enter="addMessage" @keydown="tagPeers" class="form-input flex-1 min-w-0 rounded-full border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Type your message...">
                    <button @click="addMessage" class="flex items-center rounded-full text-white text-sm font-semibold ml-3 bg-blue-600 hover:bg-blue-700 px-4 py-2 transition flex-shrink-0">
                        Send
                        <svg viewBox="0 0 16 16" class="ml-1 w-3.5 h-3.5" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"></path>
                            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </button>
                </footer>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUpdated, onUnmounted } from 'vue';

const messages = ref([]);
const newMessage = ref('');
const currentUser = window.App.user;
const activePeer = ref(false);
let typingTimer = null;
const participants = ref([]);
const expandCurrent = ref(false);

const channel = computed(() => window.Echo.join('messages'));

onMounted(() => {
    axios.get('/public/messages').then(response => (messages.value = response.data));

    channel.value
        .here(users => {
            participants.value = users;
        })
        .joining(user => {
            participants.value.push(user);
        })
        .leaving(user => {
            participants.value.splice(participants.value.indexOf(user), 1);
        })
        .listen('PublicRoomMessageCreated', ({message}) => {
            messages.value.push(message)
        })
        .listenForWhisper('typing', flashActivePeer);
});

onUpdated(() => {
    const container = document.getElementById("room-messages");
    if (container) container.scrollTop = container.scrollHeight;
});

onUnmounted(() => {
    if (typingTimer) clearTimeout(typingTimer);
});

function addMessage() {
    if (newMessage.value != null && newMessage.value.trim() != '') {
        activePeer.value = false;

        axios.post('/public/messages', {
            user_id: currentUser.id,
            message: newMessage.value
        });

        newMessage.value = '';
    }
}

function tagPeers() {
    channel.value.whisper('typing', {
        user: window.App.user
    });
}

function flashActivePeer(e) {
    activePeer.value = e;

    if (typingTimer) clearTimeout(typingTimer);

    typingTimer = setTimeout(
        () => (activePeer.value = false), 2500
    );
}
</script>

<style scoped>

</style>