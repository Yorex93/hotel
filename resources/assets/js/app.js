import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes/routes';
import store from './store';
import Vuetify from 'vuetify';
import Vuelidate from 'vuelidate';
import VueImg from 'v-img';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'



import Toastr from 'vue-toastr';
require('vue-toastr/src/vue-toastr.scss');


const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(Toastr);
Vue.use(Vuelidate);
Vue.use(VueImg);
Vue.use(vue2Dropzone);

Vue.component('vue-toastr',Toastr);

new Vue({
    router,
    store
}).$mount('#app');
