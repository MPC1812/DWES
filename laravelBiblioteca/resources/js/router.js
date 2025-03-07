import { createRouter, createWebHistory } from 'vue-router';
import BookList from './components/BookList.vue';

const routes = [
    {
        path: '/books',
        component: BookList
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;