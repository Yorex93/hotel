import * as locationService from "../../services/location-service";

const state = {
    locations: [],
    fetchingLocations: false,
    fetchedLocations: false,
    fetchLocationsError: {},

    countries: [],
    fetchingCountries: false,
    fetchedCountries: false,
    fetchCountriesError: {},

    creatingLocation: false,
    createdLocation: false,
    creatingLocationError: {},

    updatingLocation: false,
    updatedLocation: false,
    updatingLocationError: {},

};

const getters = {
    isFetchingLocation: (state) => { return state.fetchingLocations },
    isFetchingCountries: (state) => { return state.fetchingCountries },
    isCreatingLocation: (state) => { return state.creatingLocation },
    isUpdatingLocation: (state) => { return state.updatingLocation },

    creatingLocationError: (state) => { return state.creatingLocationError },
    updatingLocationError: (state) => { return state.updatingLocationError },
    fetchCountriesError: (state) => { return state.fetchCountriesError },
    fetchLocationsError: (state) => { return state.fetchLocationsError },

    createdLocation: (state) => { return state.createdLocation },
    updatedLocation: (state) => { return state.updatedLocation },
    fetchedLocations: (state) => { return state.fetchedLocations },
    fetchedCountries: (state) => { return state.fetchedCountries },

    locations: (state) => { return state.locations },
    countries: (state) => { return state.countries },
};

const actions = {
    fetchLocations({commit, dispatch}){
        commit('setFetchLocationError', {});
        commit('setFetchingLocations', true);
        locationService.getLocations().then(resp => {
            let result = resp.data;
            commit('setLocations', result.data);
            commit('setFetchedLocations', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setFetchLocationError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setFetchingLocations', false);
        })
    },

    createLocation({commit, dispatch}, data){
        commit('setCreatingLocationError', {});
        commit('setCreatingLocation', true);
        locationService.createLocationForHotel(data).then(resp => {
            dispatch('hotel/fetchHotels', {}, {root:true});
            commit('setCreatedLocation', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setCreatingLocationError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setCreatingLocation', false);
        });
    },

    updateLocation({commit, dispatch}, data){
        commit('setUpdatingLocationError', {});
        commit('setUpdatingLocation', true);
        locationService.updateLocationForHotel(data).then(resp => {
            dispatch('hotel/fetchHotels', {}, {root:true});
            commit('setUpdatedLocation', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setUpdatingLocationError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setUpdatingLocation', false);
        });
    },

    fetchCountries({commit, dispatch}){
        commit('setFetchCountriesError', {});
        commit('setFetchingCountries', true);
        locationService.getCountries().then(resp => {
            let result = resp.data;
            commit('setCountries', result.data);
            commit('setFetchedCountries', true);
        }).catch(error => {
            if (error.response) {
                if(error.response.data){
                    commit('setFetchCountriesError', error.response.data.message);
                }
            }
        }).finally(() => {
            commit('setFetchingCountries', false);
        })
    },

    clearLocationComponentData({ commit }) {
        commit('setFetchLocationError', {});
        commit('setFetchCountriesError', {});
        commit('setCreatingLocationError', {});
        commit('setUpdatingLocationError', {});
        commit('setCreatedLocation', false);
        commit('setUpdatedLocation', false);
    }
};

const mutations = {

    setLocations(state, data) {
        state.locations = data;
    },

    // FETCHING
    setFetchingLocations(state, status) {
        state.fetchingLocations = status;
    },

    setFetchedLocations(state, status) {
        state.fetchedLocations = status;
    },

    setFetchLocationError(state, error) {
        state.fetchLocationsError = error;
    },

    // CREATING
    setCreatingLocation(state, status) {
        state.creatingLocation = status;
    },

    setCreatedLocation(state, status) {
        state.createdLocation = status;
    },

    setCreatingLocationError(state, error) {
        state.creatingLocationError = error;
    },

    // UPDATING
    setUpdatingLocation(state, status) {
        state.updatingLocation = status;
    },

    setUpdatedLocation(state, status) {
        state.updatedLocation = status;
    },

    setUpdatingLocationError(state, error) {
        state.updatingLocationError = error;
    },





    setCountries(state, data) {
        state.countries = data;
    },

    setFetchingCountries(state, status) {
        state.fetchingCountries = status;
    },

    setFetchedCountries(state, status) {
        state.fetchedCountries = status;
    },

    setFetchCountriesError(state, error) {
        state.fetchCountriesError = error;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



