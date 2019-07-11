import * as authService from "../../services/auth-service";
import {getQueryParams} from "../../services/helpers";

const state = {
    user: JSON.parse(localStorage.getItem('user')),
    isLoggedIn: !!localStorage.getItem('token'),
    attemptingLogin: false,
    loginError: '',
};

const getters = {
    isLoggedIn: (state) => {
        console.log(this.$router);
        return state.isLoggedIn
    },

    attemptingLogin: (state) => {
        return state.attemptingLogin;
    },

    currentUser: (state) => {
        return state.user
    }
};

const actions = {
    login({commit, state}, {email, password, router}) {
        let queryParams = getQueryParams();
        commit('attemptLogin', true);
        return authService.login(email, password).then((response) => {
            commit('attemptLogin', false);
            commit('setUser', {user: response.data.success.user});
            localStorage.setItem('token', response.data.success.token);
            localStorage.setItem('user', JSON.stringify(response.data.success.user));

            if (queryParams['redirect']) {
                router.push({name: queryParams['redirect']});
            } else {
                router.push({name: 'dashboard'});
            }
            return Promise.resolve(response);
        }).catch(error => {
            //console.log(error.response);
            commit('attemptLogin', false);
            return Promise.reject(error);
        });
    },

    logout({commit, state}, {router}) {
        return authService.logout().then((resp) => {

        }).catch(e => {

        }).finally(() => {
            localStorage.clear();
            commit('logout');
            if (router) {
                router.replace('/admin/login');
            }
        });
    }
};

const mutations = {
    attemptLogin(state, status) {
        state.attemptingLogin = status;
    },

    logout(state) {
        state.user = null
    },

    setUser(state, {user}) {
        state.user = user;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}



