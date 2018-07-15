import Dashboard from '../screens/dashboard/Dashboard';
import Settings from '../screens/settings/Settings';
import Auth from '../screens/auth/Auth';
import NotFound from '../screens/NotFound';
import WrapperComponent from '../screens/WrapperComponent';
import Guard from '../services/middleware'


const routes = [
    { path: '/admin/login', component: Auth, beforeEnter: Guard.guest },

    { path: '/admin', component: WrapperComponent, beforeEnter: Guard.auth,
        children: [
            { path: '/', component: Dashboard, name: 'dashboard' , exact: true },
            { path: 'settings', component: Settings, name: 'settings' },
            { path: '*', component: NotFound },
        ]
    }
];
export default routes;

