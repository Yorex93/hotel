import * as hotelService from "../../services/hotels-service";

const state = {
    hotels: [],
    fetchingHotels: false,
    fetchingHotelsError: "",
    creatingHotel: false,
    creatingHotelError: "",
    updatingHotel: false,
    updatingHotelError: ""
};

const getters = {
    getHotels: (state) => {
        return state.hotels
    },

    getHotelById: (state) => (id) => {
        return state.find(h => h.id === id);
    },

    isFetching: (state) => {
        return state.fetchingHotels;
    },

    fetchingError: (state) => {
        return state.fetchingHotelsError
    },

    isCreating: (state) => {
        return state.creatingHotel;
    },

    creatingError: (state) => {
        return state.creatingHotelError
    },

    isUpdating: (state) => {
        return state.updatingHotel;
    },

    updatingError: (state) => {
        return state.updatingHotelError
    },

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
        hotelService.createHotel(data).then((resp) => {
            let result = resp.data;
            dispatch('fetchHotels');
        }).catch(error => {
            console.log(error);
        }).finally(() => {
            commit('setCreatingHotel', false);
        });
    },

    updateHotel({commit, dispatch}, { id, data }) {
        commit('setUpdatingHotel', true);
        hotelService.updateHotel(id, data).then((resp) => {
            let result = resp.data;
            dispatch('fetchHotels');
        }).catch(error => {
            console.log(error);
        }).finally(() => {
            commit('setUpdatingHotel', false);
        });
    }
};

const mutations = {
    setFetchingState(state, status) {
        state.fetchingHotels = status;
    },

    setCreatingHotel(state, status){
      state.creatingHotel = status;
    },

    setUpdatingHotel(state, status){
        state.updatingHotel = status;
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



