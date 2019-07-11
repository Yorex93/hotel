import * as hotelService from "../../services/hotels-service";

const state = {
    hotels: [],
    fetchingHotels: false,
    fetchingHotelsError: {},
    fetched: false,
    creatingHotel: false,
    creatingHotelError: {},
    created: false,
    updatingHotel: false,
    updatingHotelError: {},
    updated: false

};

const getters = {
    getHotels: (state) => {
        return state.hotels
    },

    getEligibleParentHotels: (state) => {
        return state.hotels.filter(h => h.parent_hotel_id === null)
    },

    getHotelById: (state) => (id) => {
        return state.hotels.find(h => h.id === id);
    },

    isFetchingHotels: (state) => {
        return state.fetchingHotels;
    },

    fetchingError: (state) => {
        return state.fetchingHotelsError
    },

    fetchedHotel: (state) => {
        return state.fetched;
    },

    isCreatingHotel: (state) => {
        return state.creatingHotel;
    },

    creatingHotelError: (state) => {
        return state.creatingHotelError
    },

    createdHotel: (state) => {
        return state.created
    },

    isUpdatingHotel: (state) => {
        return state.updatingHotel;
    },

    updatingHotelError: (state) => {
        return state.updatingHotelError
    },

    updatedHotel: (state) => {
        return state.updated
    }
};

const actions = {
    fetchHotels({commit}) {
        commit('setFetchingState', true);
        hotelService.getHotels().then(resp => {
            let result = resp.data;
            commit('setHotels', { hotels: result.data });
        }).catch(error => {
            console.log(error);
        }).finally(() => {
            commit('setFetchingState', false);
        });
    },

    createHotel({commit, dispatch}, data) {
        console.log(data);
        commit('setCreatingHotel', true);
        commit('setCreatingHotelError', {});
        hotelService.createHotel(data).then((resp) => {
            dispatch('fetchHotels');
            commit('setCreated', true);
        }).catch((error) => {
            if (error.response) {
                if(error.response.data){
                    commit('setCreatingHotelError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setCreatingHotel', false);
        });
    },

    updateHotel({commit, dispatch}, data) {
        commit('setUpdatingHotel', true);
        commit('setUpdatingHotelError', {});
        hotelService.updateHotel(data).then((resp) => {
            let result = resp.data;
            dispatch('fetchHotels');
            commit('setUpdated', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setCreatingHotelError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setUpdatingHotel', false);
        });
    },

    clearHotelComponentData({commit}){
        commit('setUpdatingHotelError', {});
        commit('setCreatingHotelError', {});
        commit('setCreated', false);
        commit('setUpdated', false);
    }
};

const mutations = {
    setFetchingState(state, status) {
        state.fetchingHotels = status;
    },

    setCreatingHotel(state, status){
      state.creatingHotel = status;
    },

    setCreated(state, status){
        state.created = status;
    },

    setCreatingHotelError(state, error){
        state.creatingHotelError = error;
    },

    setUpdatingHotel(state, status){
        state.updatingHotel = status;
    },

    setUpdatingHotelError(state, error){
        state.updatingHotelError = error;
    },

    setUpdated(state, status){
        state.updated = status;
    },

    setHotels(state, {hotels}) {
        state.hotels = hotels;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



