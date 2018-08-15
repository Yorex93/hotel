import Vue from 'vue'
import Vuex from 'vuex'
import user from './modules/user';
import hotel from './modules/hotel';
import location from './modules/location';
import room from './modules/room';
import facility from './modules/facility';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user,
        hotel,
        location,
        room,
        facility
    }
});