import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes/routes';
import store from './store';
import Vuetify from 'vuetify';

require('froala-editor/js/froala_editor.pkgd.min');
require('froala-editor/css/froala_editor.pkgd.min.css');
require('font-awesome/css/font-awesome.css');
require('froala-editor/css/froala_style.min.css');

window.$ = window.jQuery = require('jquery');

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg';


const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueFroala);

new Vue({
    router,
    store
}).$mount('#app');
