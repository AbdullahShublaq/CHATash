/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';

import Dropdown from './components/Dropdown.vue';
import PublicRoom from './components/publicRoom.vue';
import NewRoomModal from './components/NewRoomModal.vue';
import PrivateRoom from './components/privateRoom.vue';
import PrivateRoomCard from './components/privateRoomCard.vue';

const app = createApp({});

app.component('dropdown', Dropdown);
app.component('public-room', PublicRoom);
app.component('new-room-modal', NewRoomModal);
app.component('private-room', PrivateRoom);
app.component('private-room-card', PrivateRoomCard);

/**
 * Next, we will attach the fresh Vue application instance to the page.
 * Then, you may begin adding components to this application
 * or customizing the JavaScript scaffolding to fit your unique needs.
 */

app.mount('#app');