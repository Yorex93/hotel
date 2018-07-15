import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes/routes';
import store from './store';
import Vuetify from 'vuetify';


const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.use(VueRouter);
Vue.use(Vuetify);

new Vue({
    router,
    store
}).$mount('#app');
