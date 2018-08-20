import * as hotelServicesService from "../../services/hotel-services-service";
import StoreState from "../../models/store-state";

const state = {
    hotelServices: Object.assign({}, StoreState),
    createHotelService: Object.assign({}, StoreState),
    updateHotelService: Object.assign({}, StoreState),
    deleteHotelService: Object.assign({}, StoreState),
    parentServices: Object.assign({}, StoreState),
};

const getters = {
    getHotelServices: (state) => { return state.hotelServices },
    getParentServices: (state) => { return state.parentServices },
    getCreateHotelService: (state) => { return state.createHotelService },
    getUpdateHotelService: (state) => { return state.updateHotelService },
    getDeleteHotelService: (state) => { return state.deleteHotelService },

};

const actions = {

    fetchHotelServices({commit, dispatch}) {
        commit('setHotelServices', { type: 'LOADING', value: true });
        commit('setHotelServices', { type: 'ERROR', value: {} });
        hotelServicesService.getHotelServices().then((resp) => {
            let result = resp.data;
            commit('setHotelServices', { type: 'DATA', value: result.data });
            commit('setHotelServices', { type: 'DONE', value: true });
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setHotelServices', { type: 'ERROR', value: error.response.data.message });
                }
            }
        }).finally(() => {
            commit('setHotelServices', { type: 'LOADING', value: false});
        });
    },

    fetchParentServices({commit}) {
        commit('setParentServices', { type: 'LOADING', value: true });
        commit('setParentServices', { type: 'ERROR', value: {} });
        hotelServicesService.fetchParents().then((resp) => {
            let result = resp.data;
            commit('setParentServices', { type: 'DATA', value: result.data });
            commit('setParentServices', { type: 'DONE', value: true });
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setParentServices', { type: 'ERROR', value: error.response.data.message });
                }
            }
        }).finally(() => {
            commit('setParentServices', { type: 'LOADING', value: false});
        });
    },

    createHotelService({commit, dispatch}, data) {
        commit('setCreateHotelService', { type: 'LOADING', value: true });
        commit('setCreateHotelService', { type: 'ERROR', value: {} });
        hotelServicesService.createHotelService(data).then((resp) => {
            let result = resp.data;
            commit('setCreateHotelService', { type: 'DATA', value: result.data });
            commit('setCreateHotelService', { type: 'DONE', value: true });
            dispatch('fetchHotelServices');
        }).catch(error => {
            commit('setCreateHotelService', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setCreateHotelService', { type: 'LOADING', value: false});
        });
    },

    updateHotelService({commit, dispatch}, data) {
        commit('setUpdateHotelService', { type: 'LOADING', value: true });
        commit('setUpdateHotelService', { type: 'ERROR', value: {} });
        hotelServicesService.updateHotelService(data.id, data).then((resp) => {
            let result = resp.data;
            commit('setUpdateHotelService', { type: 'DATA', value: result.data });
            commit('setUpdateHotelService', { type: 'DONE', value: true });
            dispatch('fetchHotelServices');
        }).catch(error => {
            commit('setUpdateHotelService', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setUpdateHotelService', { type: 'LOADING', value: false});
        });
    },

    deleteHotelService({commit, dispatch}, data) {
        commit('setDeleteHotelService', { type: 'LOADING', value: true });
        commit('setDeleteHotelService', { type: 'ERROR', value: {} });
        hotelServicesService.deleteHotelService(data.id).then((resp) => {
            let result = resp.data;
            commit('setDeleteHotelService', { type: 'DATA', value: result.data });
            commit('setDeleteHotelService', { type: 'DONE', value: true });
            dispatch('fetchHotelServices');
        }).catch(error => {
            commit('setDeleteHotelService', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setDeleteHotelService', { type: 'LOADING', value: false});
        });
    },

    clearHotelServiceComponentData({commit}, dataToClear){
        if(typeof dataToClear === 'string'){
            try{
                commit(dataToClear, { type: 'DONE', value: false });
                commit(dataToClear, { type: 'ERROR', value: {} });
            } catch (e){
                console.log(`Unknown mutant: '${dataToClear}'`);
                console.log(e);
            }
        }
    }

};

const mutations = {
    setCreateHotelService(state, { type, value }) { state.createHotelService.mutate( type, value ) },
    setHotelServices(state, { type, value }) { state.hotelServices.mutate( type, value ) },
    setParentServices(state, { type, value }) { state.parentServices.mutate( type, value ) },
    setUpdateHotelService(state, { type, value }) { state.updateHotelService.mutate( type, value ) },
    setDeleteHotelService(state, { type, value }) { state.deleteHotelService.mutate( type, value ) },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



