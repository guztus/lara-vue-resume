import "bootstrap/dist/css/bootstrap.min.css";

import { createApp } from 'vue';

import App from './components/App.vue';
import router from './router';

createApp(App)
    .use(router)
    .mount("#app");

//axios.defaults.withCredentials = true

global.$ = global.jQuery = require('jquery');
import "bootstrap/dist/js/bootstrap.min.js";
