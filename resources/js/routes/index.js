import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '@/js/stores/index.js';

Vue.use(VueRouter);

// Components
import Login from '@/js/components/Login';
import Account from '@/js/components/Account';
import NotFoundComponent from '@/js/components/NotFoundComponent';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Login,
        },
        {
            path: '/api/accounts/:id',
            name: 'accounts',
            component: Account,
        },
        {
            path: '*',
            name: 'notFound',
            component: NotFoundComponent,
        }
    ]
});

// Handling Authentication

// Handling Authorization

export default router;
