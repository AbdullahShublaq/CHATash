<template>
    <modal name="new-room" classes="p-10 bg-white rounded-lg" height="auto">
        <h1 class="text-2xl font-normal mb-16 text-center">Let's Create PrivateRoom</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="name" class="text-sm text-blue-900 font-semibold block mb-2">Room Name</label>
                        <input type="text" id="name"
                               maxlength="15"
                               class="border p-2 text-xs block w-full rounded bg-transparent"
                               :class="form.errors.name ? 'border-red-500' : 'border-muted'"
                               v-model="form.name"
                        >
                        <span class="text-xs font-italic text-red-500" v-if="form.errors.name"
                              v-text="form.errors.name[0]"></span>
                    </div>
                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-2"
                        @click="$modal.hide('new-room')">Cancel
                </button>
                <button class="bg-blue-400 text-white rounded-lg py-2 px-4">Create Room</button>
            </footer>
        </form>

    </modal>
</template>

<script>
    import PrivateRoomForm from './PrivateRoomForm';

    export default {
        data() {
            return {
                form: new PrivateRoomForm({
                    name: '',
                })
            }
        },
        methods: {
            async submit() {
                this.form.submit('/private')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>

<style scoped>

</style>