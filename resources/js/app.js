require('./bootstrap');

// Lets ignore TimeZones for this small project
window.moment = require('moment');

import Vue from 'vue';
// I prefer Vuetify over other libraries (like bootstrap) when im writing front-end with VueJs
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

// Vuetify registrations with options | Vuetify is used instead of Bootstrap & jQuery
const opts = {
    icons: {
        iconfont: 'mdi',
    },
    theme: {
        dark: false,
        themes: {
            dark:  {
                primary: '#ff9800',
                secondary: '#ff5722',
                accent: '#9c27b0',
                error: '#f44336',
                warning: '#ffc107',
                info: '#00bcd4',
                success: '#4caf50'
            }
        },
    }
};
Vue.use(Vuetify);

// Main Route file
import Routes from '@/js/routes/index.js';

// Main Vuex file
import Store from '@/js/stores/index.js';

// Other plugins and modules

// Main Component file
Vue.component('App', require('./views/App.vue').default);

window.app = new Vue({
    el: '#app',
    store: Store,
    router: Routes,
    vuetify: new Vuetify(opts),
    methods: {
        //
    }
});

export default app;
