<template>
    <div class="flex flex-col bg-gradient-to-br from-indigo-100 via-slate-50 to-blue-100 dark:from-slate-950 dark:via-slate-900 dark:to-indigo-950 h-[calc(100vh-56px)] supports-[height:100dvh]:h-[calc(100dvh-56px)]">
        <div class="relative flex flex-1 min-h-0">
            <!-- Mobile drawer backdrop -->
            <div v-if="expandCurrent" class="absolute inset-0 z-[55] bg-slate-900/50 md:hidden" @click="expandCurrent = false"></div>

            <!-- Sidebar -->
            <aside :class="[expandCurrent ? 'flex' : 'hidden', 'md:flex absolute z-[60] md:static inset-y-0 left-0 w-72 md:w-64 lg:w-72 flex-col bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-r border-white/60 dark:border-white/10 shadow-2xl md:shadow-none']">
                <div class="flex items-center justify-between px-4 py-4 border-b border-white/70 dark:border-white/10 flex-shrink-0">
                    <div class="flex items-center">
                        <svg viewBox="0 0 16 16" color="#4f46e5" class="w-6 h-6 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <h1 class="text-lg font-semibold text-slate-800 dark:text-white">
                            Friends
                            <span v-text="room.participants.length" class="ml-2 inline-block rounded-full px-2 py-0.5 text-xs bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300"></span>
                        </h1>
                    </div>
                    <button type="button" class="md:hidden text-gray-500 hover:text-gray-700 dark:text-slate-400 dark:hover:text-slate-200" @click="expandCurrent = false" aria-label="Close friends list">
                        <svg viewBox="0 0 16 16" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    </button>
                </div>

                <div class="flex-1 min-h-0 overflow-y-auto p-3">
                    <div class="mb-3">
                        <div class="flex">
                            <input :class="addParticipantError ? 'border-red-500 dark:border-red-500 focus:ring-red-500/30' : 'border-gray-300/80 dark:border-white/10'" v-model="newParticipant" class="form-input flex-1 rounded-xl border bg-white/80 dark:bg-slate-800/60 px-3 py-2 text-base sm:text-sm text-gray-800 dark:text-gray-100 shadow-sm backdrop-blur focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-400/30 focus:border-indigo-500 dark:focus:border-indigo-400" type="text" placeholder="Add friend by email...">
                            <button type="button" class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-indigo-500/25 p-2 ml-2 hover:from-blue-700 hover:to-indigo-700 transition flex-shrink-0" @click="addParticipant" title="Add friend">
                                <svg viewBox="0 0 16 16" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                </svg>
                            </button>
                        </div>
                        <span v-if="addParticipantError" v-text="addParticipantError" class="mt-2 block text-xs text-red-500"></span>
                    </div>

                    <div class="divide-y divide-gray-100 dark:divide-white/10">
                        <div v-for="participant in participants" class="flex items-center py-2 px-2 rounded-lg hover:bg-white/70 dark:hover:bg-white/10">
                            <img class="w-9 h-9 rounded-full ring-2 ring-white dark:ring-slate-700" :src="participant.avatar" alt="avatar">
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800 dark:text-slate-100 truncate" v-text="participant.name"></p>
                                <p class="text-xs text-slate-400" v-text="participant.active ? 'Online' : 'Offline'"></p>
                            </div>
                            <span :class="participant.active ? 'bg-emerald-500' : 'bg-slate-300'" class="rounded-full w-3 h-3 flex-shrink-0"></span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Chat -->
            <div class="flex flex-col flex-1 min-w-0">
                <header class="flex items-center justify-between bg-gradient-to-r from-blue-700 via-indigo-700 to-indigo-900 px-4 py-3 shadow-lg shadow-indigo-950/20 flex-shrink-0">
                    <div class="flex items-center min-w-0">
                        <button type="button" class="md:hidden mr-3 text-white hover:text-blue-200" @click="expandCurrent = true" aria-label="Show friends list">
                            <svg viewBox="0 0 20 20" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                        </button>
                        <svg viewBox="0 0 16 16" class="w-6 h-6 text-white opacity-60 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"></path>
                        </svg>
                        <h1 class="text-lg font-semibold text-white truncate" v-text="room.name"></h1>
                    </div>
                    <div class="flex items-center flex-shrink-0 ml-3">
                        <a href="/home" class="flex items-center text-sm font-semibold text-white bg-rose-500 hover:bg-rose-600 rounded-xl px-3 py-1.5 shadow-md shadow-rose-500/30 transition">
                            Leave
                            <svg viewBox="0 0 16 16" class="ml-1 w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"></path>
                            </svg>
                        </a>
                    </div>
                </header>

                <div id="room-messages" class="flex-1 min-h-0 overflow-y-auto overscroll-contain px-4 py-4 bg-transparent">
                    <div class="flex flex-col space-y-3">
                        <div v-for="message in messages" :id="'message-' + message.id" :class="currentUser.id != message.user_id ? 'flex justify-start' : 'flex justify-end'">
                            <div class="flex items-end space-x-2 max-w-[85%] md:max-w-[70%]">
                                <img v-if="currentUser.id != message.user_id" class="w-8 h-8 rounded-full flex-shrink-0 mb-1" :src="message.user_avatar" alt="avatar" :title="message.user_name">
                                <div :class="currentUser.id != message.user_id ? 'bg-white/80 dark:bg-slate-800/80 backdrop-blur border border-white/70 dark:border-white/10 rounded-2xl rounded-bl-md' : 'bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl rounded-br-md'" class="px-4 py-2 shadow-md">
                                    <div v-if="message.reply_to"
                                         @click="scrollToMessage(message.reply_to.id)"
                                         :class="currentUser.id == message.user_id ? 'bg-white/15 border-white/25 hover:bg-white/25' : 'bg-slate-100/90 dark:bg-white/5 border-indigo-400/50 dark:border-indigo-400/30 hover:bg-slate-200/80 dark:hover:bg-white/10'"
                                         class="border-l-4 rounded-lg backdrop-blur px-2.5 py-1.5 mb-2 shadow-sm cursor-pointer transition"
                                         :title="'Scroll to replied message'">
                                        <p class="text-xs font-semibold truncate" :class="currentUser.id == message.user_id ? 'text-blue-100' : 'text-indigo-600 dark:text-indigo-300'" v-text="'Replying to ' + message.reply_to.user_name"></p>
                                        <p class="text-xs line-clamp-2 break-words" :class="currentUser.id == message.user_id ? 'text-blue-200/90' : 'text-slate-500 dark:text-slate-400'" v-text="message.reply_to.message"></p>
                                    </div>
                                    <p v-if="currentUser.id != message.user_id" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 mb-0.5" v-text="message.user_name"></p>
                                    <p v-text="message.message" :class="currentUser.id == message.user_id ? 'text-white' : 'text-gray-800 dark:text-slate-100'" class="leading-relaxed text-sm break-words"></p>
                                    <span v-text="message.time" :class="currentUser.id == message.user_id ? 'text-blue-100' : 'text-gray-400'" class="text-xs font-normal"></span>
                                </div>
                                <dropdown v-if="message.id"
                                          :align="currentUser.id == message.user_id ? 'right' : 'left'">
                                    <template v-slot:trigger>
                                        <button type="button"
                                                class="flex items-center justify-center w-7 h-7 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-500/10 dark:text-slate-500 dark:hover:text-slate-300 dark:hover:bg-white/10 transition"
                                                title="Message options"
                                                aria-label="Message options">
                                            <svg viewBox="0 0 16 16" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                            </svg>
                                        </button>
                                    </template>
                                    <button type="button" @click="setReply(message)"
                                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-200 no-underline hover:bg-indigo-50 dark:hover:bg-white/10 hover:text-indigo-700 dark:hover:text-indigo-300 transition text-left">
                                        <svg viewBox="0 0 16 16" class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.354 1.646a.5.5 0 0 0-.708 0L4.5 4.793a.5.5 0 1 0 .708.707L7.5 3.207V12.5a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1H8V3.207l2.293 1.293a.5.5 0 0 0 .708-.707l-3-3z"/>
                                        </svg>
                                        Reply
                                    </button>
                                    <button v-if="message.user_id == currentUser.id || currentUser.is_admin" type="button" @click="deleteMessage(message)"
                                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-rose-600 dark:text-rose-400 no-underline hover:bg-rose-50 dark:hover:bg-rose-500/10 transition text-left">
                                        <svg viewBox="0 0 16 16" class="w-3.5 h-3.5 mr-2 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg>
                                        Delete message
                                    </button>
                                </dropdown>
                            </div>
                        </div>
                        <div v-if="activePeer" class="flex justify-start items-center">
                            <img class="w-8 h-8 rounded-full mr-2" :src="activePeer.user.avatar" alt="avatar" :title="activePeer.user.name">
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur border border-white/70 dark:border-white/10 rounded-2xl rounded-bl-md px-4 py-2 shadow-md flex items-center">
                                <span class="text-xs font-semibold text-gray-600 dark:text-slate-200 mr-1" v-text="activePeer.user.name"></span>
                                <span class="text-xs text-gray-500 dark:text-slate-300">is typing</span>
                                <span class="flex space-x-0.5 ml-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-slate-300 animate-bounce" style="animation-delay: 0s"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-slate-300 animate-bounce" style="animation-delay: 0.15s"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-slate-300 animate-bounce" style="animation-delay: 0.3s"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="replyTo" class="flex items-center gap-2 px-4 py-2 bg-indigo-50/80 dark:bg-slate-800/80 backdrop-blur border-t border-white/60 dark:border-white/10 flex-shrink-0">
                    <svg viewBox="0 0 16 16" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 flex-shrink-0" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8.354 1.646a.5.5 0 0 0-.708 0L4.5 4.793a.5.5 0 1 0 .708.707L7.5 3.207V12.5a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1H8V3.207l2.293 1.293a.5.5 0 0 0 .708-.707l-3-3z"/></svg>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-300 truncate" v-text="'Replying to ' + replyTo.user_name"></p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 truncate" v-text="replyTo.message"></p>
                    </div>
                    <button type="button" @click="replyTo = null" class="flex items-center justify-center w-7 h-7 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-500/10 dark:text-slate-500 dark:hover:text-slate-300 transition" aria-label="Cancel reply">
                        <svg viewBox="0 0 16 16" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                    </button>
                </div>
                <footer class="flex items-center bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-t border-white/60 dark:border-white/10 px-4 py-3 flex-shrink-0">
                    <input ref="messageInput" v-model="newMessage" @keyup.enter="addMessage" @keydown="tagPeers" class="form-input flex-1 min-w-0 rounded-full border-gray-300/80 dark:border-white/10 bg-white/80 dark:bg-slate-800/60 px-4 py-2 text-base sm:text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 shadow-sm backdrop-blur focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-400/30" placeholder="Type your message...">
                    <button @click="addMessage" class="flex items-center rounded-full text-white text-sm font-semibold ml-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-5 py-2 shadow-md shadow-indigo-500/25 transition flex-shrink-0">
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
import { ref, computed, watch, nextTick, onMounted, onUnmounted } from 'vue';
import { playSend, playReceive, playTyping } from '../sounds';

const props = defineProps({
    room: { type: Object, required: true },
});

const messages = ref([]);
const newMessage = ref('');
const currentUser = window.App.user;
const activePeer = ref(false);
let typingTimer = null;
const participants = ref([]);
const expandCurrent = ref(false);
const newParticipant = ref('');
const addParticipantError = ref(false);
const replyTo = ref(null);
const messageInput = ref(null);
const scrolledUp = ref(false);
const forceScroll = ref(false);

const channel = computed(() => window.Echo.join('messages.' + props.room.id));

onMounted(() => {
    const container = document.getElementById("room-messages");
    if (container) container.addEventListener('scroll', handleMessagesScroll);

    participants.value = props.room.participants;

    axios.get('/private/messages', {
        params: {
            private_room_id: props.room.id
        }
    }).then(response => {
        messages.value = response.data;
        scrollMessagesToBottom();
    });

    channel.value
        .here(users => {
            users.forEach(value => {
                const participant = participants.value.find(x => x.id === value.user.id);
                if (participant) participant.active = true;
            });
        })
        .joining(user => {
            const participant = participants.value.find(x => x.id === user.user.id);
            if (participant) participant.active = true;
        })
        .leaving(user => {
            const participant = participants.value.find(x => x.id === user.user.id);
            if (participant) participant.active = false;
        })
        .listen('PrivateRoomMessageCreated', ({message}) => {
            messages.value.push(message)
            if (message.user_id === currentUser.id) playSend();
            else playReceive();
        })
        .listen('PrivateRoomMessageDeleted', ({message_id}) => {
            messages.value = messages.value.filter(m => m.id !== message_id);
        })
        .listenForWhisper('typing', flashActivePeer);
});

watch(messages, () => {
    nextTick(() => {
        if (forceScroll.value || !scrolledUp.value) {
            scrollMessagesToBottom();
        }
        forceScroll.value = false;
    });
});

onUnmounted(() => {
    if (typingTimer) clearTimeout(typingTimer);

    const container = document.getElementById("room-messages");
    if (container) container.removeEventListener('scroll', handleMessagesScroll);
});

function addMessage() {
    if (newMessage.value != null && newMessage.value.trim() != '') {
        activePeer.value = false;

        axios.post('/private/messages', {
            private_room_id: props.room.id,
            user_id: currentUser.id,
            message: newMessage.value,
            reply_to_id: replyTo.value ? replyTo.value.id : null
        });

        forceScroll.value = true;
        newMessage.value = '';
        replyTo.value = null;
    }
}

function handleMessagesScroll() {
    const container = document.getElementById("room-messages");
    if (!container) return;
    scrolledUp.value = container.scrollHeight - container.scrollTop - container.clientHeight > 80;
}

function scrollMessagesToBottom() {
    const container = document.getElementById("room-messages");
    if (!container) return;
    container.scrollTop = container.scrollHeight;
}

function setReply(message) {
    replyTo.value = message;
    newMessage.value = '';
    if (messageInput.value) messageInput.value.focus();
}

function addParticipant() {
    if (newParticipant.value != null && newParticipant.value.trim() != '') {

        axios.post('/private/addParticipant', {
            private_room_id: props.room.id,
            email: newParticipant.value,
        })
        .then(response => {
            participants.value.push(response.data);
            addParticipantError.value = false;
        })
        .catch(error => {
            addParticipantError.value = error.response.data.errors.email[0];
        });

        newParticipant.value = '';
    }
}

function tagPeers() {
    channel.value.whisper('typing', {
        user: window.App.user
    });
}

function deleteMessage(message) {
    axios.delete('/private/messages/' + message.id)
        .then(() => {
            messages.value = messages.value.filter(m => m.id !== message.id);
        });
}

function scrollToMessage(id) {
    const container = document.getElementById('room-messages');
    const el = document.getElementById('message-' + id);
    if (!container || !el) return;

    container.scrollTo({
        top: el.offsetTop - container.clientHeight / 2 + el.clientHeight / 2,
        behavior: 'smooth'
    });

    el.classList.add('flash-highlight');
    setTimeout(() => el.classList.remove('flash-highlight'), 1400);
}

function flashActivePeer(e) {
    activePeer.value = e;

    if (e.user.id !== currentUser.id) playTyping();

    if (typingTimer) clearTimeout(typingTimer);

    typingTimer = setTimeout(
        () => (activePeer.value = false), 2500
    );
}
</script>

<style scoped>
.flash-highlight {
    border-radius: 0.75rem;
    animation: flashHighlight 1.4s ease-out;
}

@keyframes flashHighlight {
    0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.55); }
    100% { box-shadow: 0 0 0 12px rgba(79, 70, 229, 0); }
}
</style>