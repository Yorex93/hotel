import Dashboard from '../screens/dashboard/Dashboard';
import Settings from '../screens/settings/Settings';
import Auth from '../screens/auth/Auth';
import NotFound from '../screens/NotFound';
import WrapperComponent from '../screens/WrapperComponent';
import Guard from '../services/middleware';
import HotelsList from '../screens/hotels/List';
import EditHotel from '../screens/hotels/Edit';


const routes = [
    { path: '/admin/login', component: Auth, beforeEnter: Guard.guest },

    { path: '/admin', component: WrapperComponent, beforeEnter: Guard.auth,
        children: [
            { path: '', name: '' , exact: true, redirect: 'dashboard' },
            { path: 'dashboard', component: Dashboard, name: 'dashboard' },
            { path: 'hotels', component: HotelsList, name: 'hotels' },
            { path: 'hotels/create', component: EditHotel, name: 'newHotel' },
            { path: 'hotels/:id/edit', component: EditHotel, name: 'editHotel' },
            { path: 'settings', component: Settings, name: 'settings' },
            { path: '*', component: NotFound },
        ]
    }
];
export default routes;

