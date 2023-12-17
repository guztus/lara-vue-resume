import "bootstrap/dist/css/bootstrap.min.css";

import { createApp } from 'vue';

import App from './components/App.vue';
import router from './router';

createApp(App)
    .use(router)
    .mount("#app");

import "bootstrap/dist/js/bootstrap.min.js";
