<template>
    <div class="m-4">
        <a :href="room.path" class="block group">
            <div class="flex flex-col card min-w-[15rem] p-8 items-center shadow-lg transition group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:shadow-indigo-950/10">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 shadow-md shadow-indigo-500/30 flex items-center justify-center mb-4">
                    <svg viewBox="0 0 16 16" class="w-7 h-7 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold font-mono text-lg text-slate-800 dark:text-white text-center break-words w-full" v-text="room.name"></h3>
                <div class="flex justify-center w-full mt-4 gap-5">
                    <div class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                        <svg viewBox="0 0 16 16" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <span class="font-medium text-sm" v-text="room.participantsCount"></span>
                    </div>
                    <div class="flex items-center gap-1.5 text-emerald-600">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="font-medium text-sm" v-text="activePeerCount"></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    room: { type: Object, required: true },
});

const activePeerCount = ref(0);

const channel = computed(() => window.Echo.join('messages.' + props.room.id));

onMounted(() => {
    channel.value
        .here(users => {
            activePeerCount.value = users.length;
        })
        .joining(() => {
            activePeerCount.value++;
        })
        .leaving(() => {
            activePeerCount.value--;
        });
});
</script>

<style scoped>

</style>