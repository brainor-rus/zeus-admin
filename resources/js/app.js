import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';
import VueCookie from 'vue-cookie';

Vue.use(VueRouter);
Vue.use(VueCookie);

global.Vue = Vue;

import App from './components/App';
import Home from './components/Home';
import GeneralComponent from './components/GeneralComponent';
import './bootstrap';

Vue.component('EditableCheckboxComponent', require('./components/SectionBuilder/Display/Table/EditableCheckboxComponent.vue'));

import VuexFlash from 'vuex-flash';

Vue.use(VuexFlash, { mixin: true });

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '*',
            name: 'general-component',
            component: GeneralComponent
        },
    ],
});

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
});
