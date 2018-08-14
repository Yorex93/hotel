import * as roomService from "../../services/rooms-service";
import StoreState from "../../models/store-state";

const state = {
    roomTypes: Object.assign({}, StoreState),
    createRoomType: Object.assign({}, StoreState),
    updateRoomType: Object.assign({}, StoreState),
    deleteRoomType: Object.assign({}, StoreState),

    rooms: Object.assign({}, StoreState),
    createRooms: Object.assign({}, StoreState),
    updateRooms: Object.assign({}, StoreState),
    deleteRooms: Object.assign({}, StoreState),
};

const getters = {
    getRoomTypes: (state) => { return state.roomTypes },
    getCreateRoomType: (state) => { return state.createRoomType },
    getUpdateRoomType: (state) => { return state.updateRoomType },
    getDeleteRoomType: (state) => { return state.deleteRoomType },

    getRooms: (state) => { return state.rooms },
    getCreateRooms: (state) => { return state.createRooms },
    getUpdateRooms: (state) => { return state.updateRooms },
    getDeleteRooms: (state) => { return state.deleteRooms },
};

const actions = {

    fetchRoomTypes({commit, dispatch}) {
        commit('setRoomTypes', { type: 'LOADING', value: true });
        commit('setRoomTypes', { type: 'ERROR', value: {} });
        roomService.getRoomTypes().then((resp) => {
            let result = resp.data;
            commit('setRoomTypes', { type: 'DATA', value: result.data });
            commit('setRoomTypes', { type: 'DONE', value: true });
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setRoomTypes', { type: 'ERROR', value: error.response.data.message });
                }
            }
        }).finally(() => {
            commit('setRoomTypes', { type: 'LOADING', value: false});
        });
    },

    createRoomType({commit, dispatch}, data) {
        commit('setCreateRoomType', { type: 'LOADING', value: true });
        commit('setCreateRoomType', { type: 'ERROR', value: {} });
        roomService.createRoomType(data).then((resp) => {
            let result = resp.data;
            commit('setCreateRoomType', { type: 'DATA', value: result.data });
            commit('setCreateRoomType', { type: 'DONE', value: true });
            dispatch('fetchRoomTypes');
        }).catch(error => {
            commit('setCreateRoomType', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setCreateRoomType', { type: 'LOADING', value: false});
        });
    },

    updateRoomType({commit, dispatch}, data) {
        commit('setUpdateRoomType', { type: 'LOADING', value: true });
        commit('setUpdateRoomType', { type: 'ERROR', value: {} });
        roomService.updateRoomType(data.id, data).then((resp) => {
            let result = resp.data;
            commit('setUpdateRoomType', { type: 'DATA', value: result.data });
            commit('setUpdateRoomType', { type: 'DONE', value: true });
            dispatch('fetchRoomTypes');
        }).catch(error => {
            commit('setUpdateRoomType', { type: 'ERROR', value: error });
        }).finally(() => {
            commit('setUpdateRoomType', { type: 'LOADING', value: false});
        });
    },

    clearRoomComponentData({commit}, dataToClear){
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

    setCreateRoomType(state, { type, value }) { state.createRoomType.mutate( type, value ) },
    setRoomTypes(state, { type, value }) { state.roomTypes.mutate( type, value ) },
    setUpdateRoomType(state, { type, value }) { state.updateRoomType.mutate( type, value ) },
    setDeleteRoomType(state, { type, value }) { state.deleteRoomType.mutate( type, value ) },

    setCreateRooms(state, { type, value }) { state.createRooms.mutate( type, value ) },
    setRooms(state, { type, value }) { state.roomTypes.mutate( type, value ) },
    setUpdateRooms(state, { type, value }) { state.updateRooms.mutate( type, value ) },
    setDeleteRooms(state, { type, value }) { state.deleteRooms.mutate( type, value ) },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



