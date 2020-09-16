<template>
    <div class="flex flex-wrap h-full" style="height: calc(100vh - 56px)">
        <!--start-activatedUser-side-->
        <div class="flex flex-col w-full lg:w-1/4">
            <div id="activated-header" class="flex items-center justify-between text-blue-500 shadow-lg w-full py-4 px-4">
                <div class="flex items-center w-full justify-between">
                    <div class="flex items-center pl-4">
                        <svg viewBox="0 0 16 16" color="#63b3ed" class="w-6 h-6 bi bi-globe opacity-20"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <h1 class="text-xl font-semibold font-mono ml-2">
                            Friends
                            <span v-text="this.room.participants.length" class="rounded-full p-2 text-xs bg-blue-400 text-white"></span>
                        </h1>
                    </div>
                </div>
                <div @click="expandCurrent = !expandCurrent" class="block lg:hidden">
                    <button class="flex items-center px-3 py-2 border rounded text-blue-400 border-blue-400 border">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
            </div>
            <div id="activated-body" :class="expandCurrent ? 'block' : 'hidden'" class="lg:block overflow-y-scroll py-2 px-2"
                 style="height: calc(100vh - 56px - 57px); max-height: calc(100vh - 56px - 57px)">
                <div class="flex rounded-lg shadow-lg items-center bg-white p-2 text-black mb-2">
                    <input v-model="newParticipant" class="rounded border border-gray-400 w-full px-2 py-1" type="text" placeholder="Add new friend by email...">
                    <button class="rounded bg-blue-400 text-white p-1 ml-2" @click="addParticipant">
                        <svg viewBox="0 0 16 16" class="w-5 h-5 bi bi-globe"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg items-start bg-white p-2 text-blue-500">
                    <div v-for="participant in this.participants" class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             :src="participant.avatar"
                             alt="avatar">
                        <span :class="participant.active ? 'bg-green-400' : 'bg-red-400'" class="rounded-full w-3 h-3"></span>
                        <span v-text="participant.name" class="text-lg pr-4 ml-2 break-words"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--end-activatedUser-side-->

        <!--start-messages-side-->
        <div class="flex flex-col w-full lg:w-3/4">
            <div id="room-header" class="flex items-center justify-between bg-blue-400 z-10 shadow-lg w-full py-4 px-6">
                <div class="flex items-center">
                    <svg viewBox="0 0 16 16" color="#FFF" class="w-6 h-6 bi bi-globe opacity-20" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"></path>
                    </svg>
                    <h1 class="text-xl text-white font-mono ml-2" v-text="this.room.name"></h1>
                </div>
                <div class="flex items-center">
                    <a href="/home"
                       class="flex items-center rounded rounded-lg font-semibold text-sm text-white bg-red-500 px-2 py-1">
                        Leave
                        <svg viewBox="0 0 16 16" class="ml-1 w-4 h-4 bi bi-globe opacity-20" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="room-messages" class="overflow-auto bg-white"
                 style="height: calc(100vh - 56px - 56px - 58px); max-height: calc(100vh - 56px - 56px - 58px)">
                <div class="flex flex-col">
                    <div class="p-1" v-for="message in messages">
                        <div v-if="currentUser.id != message.user_id" class="flex justify-start">
                            <img class="w-10 h-10 rounded-full"
                                 :src="message.user_avatar"
                                 alt="avatar"
                                 :title="message.user_name">
                            <div class="flex flex-col rounded-tl-none rounded-lg w-full md:w-auto md:max-w-lg ml-1 bg-gray-200 py-2 px-4">
                                <p v-text="message.message" class="leading-normal text-sm mb-2"></p>
                                <span v-text="message.time" class="text-xs text-gray-600 font-light"></span>
                            </div>
                        </div>
                        <div v-else class="flex justify-end">
                            <div class="flex flex-col rounded-tr-none rounded-lg w-full md:w-auto md:max-w-lg bg-blue-500 py-2 px-4">
                                <p v-text="message.message" class="leading-normal text-sm text-white mb-2"></p>
                                <span v-text="message.time" class="text-xs text-gray-300 font-light"></span>
                            </div>
                        </div>
                    </div>
                    <div v-if="activePeer" class="flex justify-start my-2">
                        <img class="w-8 h-8 rounded-full"
                             :src="activePeer.user.avatar"
                             alt="avatar"
                             :title="activePeer.user.name">
                        <div class="flex items-center rounded-tl-none rounded-lg w-auto ml-2 bg-gray-200 px-2">
                            <p class="text-xs font-semibold font-mono">Typing...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="room-footer" class="flex items-center justify-between bg-gray-300 w-full py-2 px-6">
                <input v-model="newMessage" @keyup.enter="addMessage" @keydown="tagPeers"
                       class="rounded rounded-lg w-full px-4 py-2 form-input" rows="1"
                       placeholder="Enter your message...">
                <button @click="addMessage"
                        class="flex items-center rounded rounded-lg text-white text-sm font-semibold font-mono ml-16 bg-blue-500 py-2 px-4">
                    Send
                    <svg viewBox="0 0 16 16" class="ml-1 w-3 h-3 bi bi-globe opacity-20" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        <path fill-rule="evenodd"
                              d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!--end-messages-side-->
    </div>
</template>

<script>
    export default {
        props: ['room'],
        data() {
            return {
                messages: [],
                newMessage: '',
                currentUser: window.App.user,
                activePeer: false,
                typingTimer: false,
                participants: [],
                expandCurrent: false,
                newParticipant: '',
            };
        },

        computed: {
            channel() {
                return window.Echo.join('messages.' + this.room.id);
            }
        },

        created() {
            this.participants = this.room.participants;

            axios.get('/private/messages', {
                params: {
                    private_room_id: this.room.id
                }
            }).then(response => (this.messages = response.data));

            this.channel
                .here(users => {
                    var participants = this.participants;
                    $.each(users, function(key, value) {
                        participants.find(x => x.id === value.user.id).active = true;
                    });
                })
                .joining(user => {
                    this.participants.find(x => x.id === user.user.id).active = true;
                })
                .leaving(user => {
                    this.participants.find(x => x.id === user.user.id).active = false;
                })
                .listen('PrivateRoomMessageCreated', ({message}) => {
                    this.messages.push(message)
                })
                .listenForWhisper('typing', this.flashActivePeer);
        },

        updated() {
            var container = this.$el.querySelector("#room-messages");
            container.scrollTop = container.scrollHeight;
        },

        methods: {
            addMessage() {
                if (this.newMessage != null && this.newMessage.trim() != '') {
                    this.activePeer = false;

                    axios.post('/private/messages', {
                        private_room_id: this.room.id,
                        user_id: this.currentUser.id,
                        message: this.newMessage
                    });

                    this.newMessage = '';
                }
            },

            addParticipant(){
                if (this.newParticipant != null && this.newParticipant.trim() != '') {

                    axios.post('/private/addParticipant', {
                        private_room_id: this.room.id,
                        email: this.newParticipant,
                    }).then(response => (this.participants.push(response.data)));

                    this.participants.push();

                    this.newParticipant = '';
                }
            },

            tagPeers() {
                this.channel.whisper('typing', {
                    user: window.App.user
                });
            },

            flashActivePeer(e) {
                this.activePeer = e;

                if (this.typingTimer) clearTimeout(this.typingTimer);

                this.typingTimer = setTimeout(
                    () => (this.activePeer = false), 2500
                );
            },
        }
    }
</script>

<style scoped>

</style>