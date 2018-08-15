import * as facilityService from "../../services/facility-service";
import StoreState from "../../models/store-state";

const state = {
    facilities: Object.assign({}, StoreState),
    createFacility: Object.assign({}, StoreState),
    updateFacility: Object.assign({}, StoreState),
    deleteFacility: Object.assign({}, StoreState),
};

const getters = {
    getFacilities: (state) => { return state.facilities },
    getCreateFacility: (state) => { return state.createFacility },
    getUpdateFacility: (state) => { return state.updateFacility },
    getDeleteFacility: (state) => { return state.deleteFacility },
};

const actions = {

    fetchFacilities({commit, dispatch}) {
        commit('setFacilities', { type: 'LOADING', value: true });
        commit('setFacilities', { type: 'ERROR', value: {} });
        facilityService.getFacilities().then((resp) => {
            let result = resp.data;
            commit('setFacilities', { type: 'DATA', value: result.data });
            commit('setFacilities', { type: 'DONE', value: true });
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setFacilities', { type: 'ERROR', value: error.response.data.message });
                }
            }
        }).finally(() => {
            commit('setFacilities', { type: 'LOADING', value: false});
        });
    },

    createFacility({commit, dispatch}, data) {
        commit('setCreateFacility', { type: 'LOADING', value: true });
        commit('setCreateFacility', { type: 'ERROR', value: {} });
        facilityService.createFacility(data).then((resp) => {
            let result = resp.data;
            commit('setCreateFacility', { type: 'DATA', value: result.data });
            commit('setCreateFacility', { type: 'DONE', value: true });
            dispatch('fetchFacilities');
        }).catch(error => {
            commit('setCreateFacility', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setCreateFacility', { type: 'LOADING', value: false});
        });
    },

    updateFacility({commit, dispatch}, data) {
        commit('setUpdateFacility', { type: 'LOADING', value: true });
        commit('setUpdateFacility', { type: 'ERROR', value: {} });
        facilityService.updateFacility(data.id, data).then((resp) => {
            let result = resp.data;
            commit('setUpdateFacility', { type: 'DATA', value: result.data });
            commit('setUpdateFacility', { type: 'DONE', value: true });
            dispatch('fetchFacilities');
        }).catch(error => {
            commit('setUpdateFacility', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setUpdateFacility', { type: 'LOADING', value: false});
        });
    },

    deleteFacility({commit, dispatch}, data) {
        commit('setUpdateFacility', { type: 'LOADING', value: true });
        commit('setUpdateFacility', { type: 'ERROR', value: {} });
        facilityService.deleteFacility(data).then((resp) => {
            let result = resp.data;
            commit('setUpdateFacility', { type: 'DATA', value: result.data });
            commit('setUpdateFacility', { type: 'DONE', value: true });
            dispatch('fetchFacilities');
        }).catch(error => {
            commit('setUpdateFacility', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setUpdateFacility', { type: 'LOADING', value: false});
        });
    },


    clearFacilityComponentData({commit}, dataToClear){
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

    setCreateFacility(state, { type, value }) { state.createFacility.mutate( type, value ) },
    setFacilities(state, { type, value }) { state.facilities.mutate( type, value ) },
    setUpdateFacility(state, { type, value }) { state.updateFacility.mutate( type, value ) },
    setDeleteFacility(state, { type, value }) { state.deleteFacility.mutate( type, value ) },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



