import Vue from 'vue'

export default {
    user () {
        return this.$store.state.user
    },

    check () {
        return localStorage.getItem('token') //get token from localStorage
    }
}