<template>
    <div ref="root" class="dropdown relative cursor-pointer z-50">
        <div class="dropdown-toggle"
             aria-haspopup="true"
             :aria-expanded="isOpen"
             @click.prevent="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen"
             @click="isOpen = false"
             class="dropdown-menu absolute top-full mt-2 py-1.5 min-w-[10rem] rounded-xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-white/60 dark:border-white/10 shadow-xl shadow-indigo-950/10 dark:shadow-black/40 z-50"
             :class="align === 'left' ? 'left-0' : 'right-0'"
             :style="{ width }">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onBeforeUnmount } from 'vue';

const props = defineProps({
    width: { type: String, default: 'auto' },
    align: { type: String, default: 'left' }
});

const root = ref(null);
const isOpen = ref(false);

watch(isOpen, (open) => {
    if (open) {
        document.addEventListener('click', closeIfClickOutside);
    }
});

onBeforeUnmount(() => {
    document.removeEventListener('click', closeIfClickOutside);
});

function closeIfClickOutside(event) {
    if (root.value && !root.value.contains(event.target)) {
        isOpen.value = false;
        document.removeEventListener('click', closeIfClickOutside);
    }
}
</script>

<style scoped>

</style>