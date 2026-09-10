<template>
    <div class="dropdown relative cursor-pointer z-50">
        <div class="dropdown-toggle"
             aria-haspopup="true"
             :aria-expanded="isOpen"
             @click.prevent="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen"
             class="dropdown-menu absolute text-center bg-white py-2 rounded shadow mt-2"
             :class="align === 'left' ? 'pin-l' : 'pin-r'"
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
    if (! event.target.closest('.dropdown')) {
        isOpen.value = false;
        document.removeEventListener('click', closeIfClickOutside);
    }
}
</script>

<style scoped>

</style>