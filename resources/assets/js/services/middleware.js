import user from './auth';

export default {
    guest (to, from, next) {
        next(!user.check() ? true: {
            path: '/admin'
        })
    },

    auth (to, from, next) {
        next(user.check() ? true : {
            path: '/admin/login',
            query: {
                redirect: to.name
            }
        })
    }
}