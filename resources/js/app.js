
require('./bootstrap');

window.Vue = require('vue');

// global event bus
window.EventBus = new Vue();

Vue.prototype.$userName = document.querySelector("meta[name='user_name']").getAttribute('content');
Vue.prototype.$authUserId = document.querySelector("meta[name='user_id']").getAttribute('content');


import Snotify, { SnotifyPosition } from 'vue-snotify'
import Master from './components/Master.vue';
import VueRouter from 'vue-router';
import {routes} from './routes.js';

const SnotifyOptions = {
    toast: {
        position: SnotifyPosition.rightTop
    }
}

Vue.use(Snotify, SnotifyOptions)

Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(Master),
});
