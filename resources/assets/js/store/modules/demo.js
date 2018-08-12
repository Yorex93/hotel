import * as demo from "../../services/demo";

const state = {
    demo: []
};

const getters = {

};

const actions = {

    updateHotel({commit, dispatch}, data) {
        commit('setDemo', true);
        demo.getDemo().then((resp) => {
            let result = resp.data;
            dispatch('fetchHotels');
            commit('setUpdated', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){

                }
            }
        }).finally(() => {
            commit('setDemo', false);
        });
    },

};

const mutations = {
    setDemo(state, status) {
        state.fetchingHotels = status;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



