import { createApp } from 'vue'
import { createPinia } from 'pinia'
import VueSmoothScroll from 'vue3-smooth-scroll';
import './plugins/axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';

import App from './App.vue'
import router from './router'

const pinia = createPinia()

createApp(App)
    .use(pinia)
    .use(router)
    .use(VueSmoothScroll, {
        updateHistory: false
    }).mount('#app')
