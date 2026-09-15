<template>
    <div>
        <div class="flex flex-wrap items-center justify-between gap-4 w-full">
            <h2 class="text-slate-700 text-xl font-semibold">My PrivateRooms</h2>
            <button type="button" class="btn-primary" @click="show = true">Create room</button>
        </div>

        <transition name="fade">
            <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="show = false"></div>
                <div class="relative card p-6 sm:p-10 w-full max-w-md my-auto">
                    <h1 class="text-2xl font-normal mb-8 text-center text-slate-800">Let's Create PrivateRoom</h1>

                    <form @submit.prevent="submit">
                        <div class="mb-6">
                            <label for="name" class="text-sm text-slate-700 font-medium block mb-2">Room Name</label>
                            <input type="text" id="name"
                                   maxlength="15"
                                   class="input"
                                   :class="form.errors.name ? 'border-red-500 focus:ring-red-500/30' : ''"
                                   v-model="form.name">
                            <span class="text-xs text-red-500 mt-2 block" v-if="form.errors.name"
                                  v-text="form.errors.name[0]"></span>
                        </div>

                        <footer class="flex justify-end gap-2">
                            <button type="button" class="btn-ghost" @click="show = false">Cancel</button>
                            <button class="btn-primary">Create Room</button>
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