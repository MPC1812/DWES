import './bootstrap';
import {createApp} from 'vue';
import HelloWorld from './components/HelloWorld.vue';
import BookList from './components/BookList.vue';

import router from "./router";

//Crear aplicación
//createApp(HelloWorld).mount('#app');
//createApp(BookList).mount('#app');
//createApp(BookList).use(router).mount('#app');
createApp(HelloWorld).use(router).mount('#app');

