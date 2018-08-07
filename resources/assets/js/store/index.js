import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user';
import hotel from './modules/hotel';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        hotel
    }
});