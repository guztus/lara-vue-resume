import 'bootstrap/dist/css/bootstrap.min.css';
// require ('../../ bootstrap');
import * as bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js';
window.bootstrap = bootstrap

import { createApp } from 'vue';

import App from './components/App.vue';
import router from './router';
import axios from 'axios'
import store from './store'

axios.defaults.withCredentials = true

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');

store.dispatch('getUser').then(()=>{
    createApp(App)
        .use(router)
        .use(store)
        .mount('#app');
})

import 'bootstrap/dist/js/bootstrap.min.js';
