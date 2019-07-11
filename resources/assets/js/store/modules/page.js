import * as pageService from "../../services/page-service";
import StoreState from "../../models/store-state";

const state = {
    pageItems: Object.assign({}, StoreState),
    updatePageItem: Object.assign({}, StoreState),
};

const getters = {
    getPageItems: (state) => { return state.pageItems },
    getUpdatePageItem: (state) => { return state.updatePageItem },
};

const actions = {

    fetchPageItems({commit, dispatch}) {
        commit('setPageItems', { type: 'LOADING', value: true });
        commit('setPageItems', { type: 'ERROR', value: {} });
        pageService.getPageItems().then((resp) => {
            let result = resp.data;
            commit('setPageItems', { type: 'DATA', value: result.data });
            commit('setPageItems', { type: 'DONE', value: true });
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setPageItems', { type: 'ERROR', value: error.response.data.message });
                }
            }
        }).finally(() => {
            commit('setPageItems', { type: 'LOADING', value: false});
        });
    },


    updatePageItem({commit, dispatch}, data) {
        commit('setUpdatePageItem', { type: 'LOADING', value: true });
        commit('setUpdatePageItem', { type: 'ERROR', value: {} });
        pageService.updatePageItem(data.id, data).then((resp) => {
            let result = resp.data;
            commit('setUpdatePageItem', { type: 'DATA', value: result.data });
            commit('setUpdatePageItem', { type: 'DONE', value: true });
            dispatch('fetchPageItems');
        }).catch(error => {
            commit('setUpdatePageItem', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setUpdatePageItem', { type: 'LOADING', value: false});
        });
    },

    clearPageComponentData({commit}, dataToClear){
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

    setUpdatePageItem(state, { type, value }) { state.updatePageItem.mutate( type, value ) },
    setPageItems(state, { type, value }) { state.pageItems.mutate( type, value ) },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



