require('./bootstrap');
import Vue from 'vue'
import App from "./App.vue";
import VueRouter from 'vue-router'
import routes from './routes/routes'


const router = new VueRouter({mode: 'history',routes});

Vue.use(VueRouter);

new Vue({
    render: h => h(App),
    router,
}).$mount('#app');
