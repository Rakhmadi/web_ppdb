
import Vue from 'vue'
require('./bootstrap');
import router from './router'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);
window.Vue = require('vue');
import vuetify from './vuetify';
import 'vuetify/dist/vuetify.min.css';
import App from './components/app';
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js');
    });
}
const app = new Vue({
    el: '#app',
    vuetify,
    components:{App},
    router,
}).$mount('#app');
