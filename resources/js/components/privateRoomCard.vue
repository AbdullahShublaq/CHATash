<template>
    <div class="m-4">
        <a :href="this.room.path">
            <div class="flex flex-col bg-white rounded-lg py-8 px-12 items-center shadow-lg border hover:border-blue-900">
                <h3 class="font-light font-mono text-lg text-blue-900" v-text="this.room.name"></h3>
                <div class="flex justify-center w-full mt-3">
                    <div class="flex items-center mx-2">
                        <svg viewBox="0 0 16 16" color="#2a4365" class="w-5 h-5 bi bi-globe opacity-50"
                             fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <span class="font-semibold font-mono text-blue-900 ml-1" v-text="this.room.participantsCount"></span>
                    </div>
                    <div class="flex items-center mx-2">
                        <svg viewBox="0 0 16 16" class="text-green-500 w-5 h-5 bi bi-globe" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                        </svg>
                        <span class="font-semibold font-mono text-green-500 ml-1" v-text="this.activePeerCount"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['room'],
        data() {
            return {
                activePeerCount: 0,
            };
        },

        computed: {
            channel() {
                return window.Echo.join('messages.' + this.room.id);
            }
        },

        created() {
            this.channel
                .here(users => {
                    this.activePeerCount = users.length;
                })
                .joining(user => {
                    this.activePeerCount++;
                })
                .leaving(user => {
                    this.activePeerCount--;
                })
                .listen('PrivateRoomMessageCreated');
        },

    }
</script>

<style scoped>

</style>