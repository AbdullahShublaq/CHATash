<template>
    <div>
        <div class="flex justify-between w-full items-end">
            <h2 class="text-gray-600 text-lg font-semibold">My PrivateRooms</h2>
            <button type="button" class="bg-blue-400 text-white rounded-lg py-2 px-4" @click="show = true">Create room</button>
        </div>

        <transition name="fade">
            <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center">
                <div class="absolute inset-0 bg-gray-900 opacity-50" @click="show = false"></div>
                <div class="relative p-10 bg-white rounded-lg w-full max-w-md mx-4">
                    <h1 class="text-2xl font-normal mb-16 text-center">Let's Create PrivateRoom</h1>

                    <form @submit.prevent="submit">
                        <div class="flex">
                            <div class="flex-1 mr-4">
                                <div class="mb-4">
                                    <label for="name" class="text-sm text-blue-900 font-semibold block mb-2">Room Name</label>
                                    <input type="text" id="name"
                                           maxlength="15"
                                           class="border p-2 text-xs block w-full rounded bg-transparent"
                                           :class="form.errors.name ? 'border-red-500' : ''"
                                           v-model="form.name"
                                    >
                                    <span class="text-xs font-italic text-red-500" v-if="form.errors.name"
                                          v-text="form.errors.name[0]"></span>
                                </div>
                            </div>
                        </div>

                        <footer class="flex justify-end">
                            <button type="button" class="button is-outlined mr-2"
                                    @click="show = false">Cancel
                            </button>
                            <button class="bg-blue-400 text-white rounded-lg py-2 px-4">Create Room</button>
                        </footer>
                    </form>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PrivateRoomForm from './PrivateRoomForm';

const form = ref(new PrivateRoomForm({
    name: '',
}));

const show = ref(false);

function submit() {
    form.value.submit('/private')
        .then(response => location = response.data.message);
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.15s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>