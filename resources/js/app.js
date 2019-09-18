import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

Vue.use(VueRouter)
Vue.use(VueResource)

import App from './views/App'
import Home from './views/Home'
import Index from './views/Index'
import Create from './views/Create'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/index',
            name: 'index',
            component: Index
        },
        {
            path: '/create',
            name: 'create',
            component: Create
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});