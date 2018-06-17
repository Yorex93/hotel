import Dashboard from '../screens/dashboard/Dashboard';
import Properties from '../screens/properties/Properties';
import Partners from '../screens/partners/Partners';
import Auth from '../screens/auth/Auth';
import NotFound from '../screens/NotFound';
import WrapperComponent from '../screens/WrapperComponent';
import Guard from '../services/middleware'


const routes = [
    { path: '/admin', component: WrapperComponent,
        children: [
            { path: 'login', component: Auth, beforeEnter: Guard.guest, name: 'login' },
            { path: '/', component: Dashboard, name: 'dashboard' , exact: true },
            { path: 'properties', component: Properties, name: 'properties' },
            { path: 'partners', component: Partners, name: 'partners' },
            { path: '*', component: NotFound },
        ]
    }
];
export default routes;

