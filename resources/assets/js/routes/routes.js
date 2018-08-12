import Dashboard from '../screens/dashboard/Dashboard';
import Settings from '../screens/settings/Settings';
import Auth from '../screens/auth/Auth';
import NotFound from '../screens/NotFound';
import WrapperComponent from '../screens/WrapperComponent';
import Guard from '../services/middleware';

/**
 * Hotels
 */
import HotelList from '../screens/hotels/HotelList';
import HotelEdit from '../screens/hotels/HotelEdit';
import HotelCreate from '../screens/hotels/HotelCreate';

/**
 * Room Types
 */
import RoomTypeList from '../screens/rooms/room_types/RoomTypeList';
import RoomTypeCreate from '../screens/rooms/room_types/RoomTypeCreate';
import RoomTypeEdit from '../screens/rooms/room_types/RoomTypeEdit';


/**
 * Rooms
 */
import RoomList from '../screens/rooms/room_type_rooms/RoomList';

/**
 * Activities
 */
import ActivityList from '../screens/activities/ActivityList';
import ActivityCreate from '../screens/activities/ActivityCreate';
import ActivityEdit from '../screens/activities/ActivityEdit';


/**
 * Facilities
 */
import FacilityList from '../screens/facilities/FacilityList';
import FacilityCreate from '../screens/facilities/FacilityCreate';
import FacilityEdit from '../screens/facilities/FacilityEdit';

/**
 * Services
 */
import ServiceList from '../screens/services/ServiceList';
import ServiceCreate from '../screens/services/ServiceCreate';
import ServiceEdit from '../screens/services/ServiceEdit';


/**
 * Bookings
 */
import BookingList from '../screens/bookings/BookingList';
import BookingCreate from '../screens/bookings/BookingCreate';
import BookingEdit from '../screens/bookings/BookingEdit';
import BookingSingle from '../screens/bookings/BookingSingle';

/**
 * Payments
 */
import PaymentList from '../screens/payments/PaymentList';
import PaymentSingle from '../screens/payments/PaymentSingle';

/**
 * Users
 */
import UserList from '../screens/users/UserList';
import UserCreate from '../screens/users/UserCreate';
import UserEdit from '../screens/users/UserEdit';

/**
 * Coupons
 */
import CouponList from '../screens/coupons/CouponList';
import CouponEdit from '../screens/coupons/CouponEdit';
import CouponCreate from '../screens/coupons/CouponCreate';


const routes = [
    { path: '/admin/login', component: Auth, beforeEnter: Guard.guest },

    { path: '/admin', component: WrapperComponent, beforeEnter: Guard.auth,
        children: [
            { path: '', name: '' , exact: true, redirect: 'dashboard' },
            { path: 'dashboard', component: Dashboard, name: 'dashboard' },
            { path: 'hotels', component: HotelList, name: 'hotels' },
            { path: 'hotels/create', component: HotelCreate, name: 'newHotel' },
            { path: 'hotels/:id/edit', component: HotelEdit, name: 'editHotel' },


            { path: 'room-types', component: RoomTypeList, name: 'roomTypes' },
            { path: 'room-types/create', component: RoomTypeEdit, name: 'createRoomType' },
            { path: 'room-types/:id/edit', component: RoomTypeCreate, name: 'editRoomType' },

            { path: 'rooms', component: RoomList, name: 'rooms' },

            { path: 'activities', component: ActivityList, name: 'activities' },
            { path: 'activities/create', component: ActivityCreate, name: 'createActivity' },
            { path: 'activities/:id/edit', component: ActivityCreate, name: 'editActivity' },

            { path: 'facilities', component: FacilityList, name: 'facilities' },
            { path: 'facilities/create', component: FacilityCreate, name: 'createFacility' },
            { path: 'facilities/:id/edit', component: FacilityEdit, name: 'editFacility' },

            { path: 'services', component: ServiceList, name: 'services' },
            { path: 'services/create', component: ServiceCreate, name: 'createService' },
            { path: 'services/:id/edit', component: ServiceEdit, name: 'editService' },

            { path: 'bookings', component: BookingList, name: 'bookings' },
            { path: 'bookings/create', component: BookingCreate, name: 'createBooking' },
            { path: 'bookings/:id/view', component: BookingSingle, name: 'viewBooking' },
            { path: 'bookings/:id/edit', component: BookingEdit, name: 'editBooking' },

            { path: 'payments', component: PaymentList, name: 'payments' },
            { path: 'payments/:id/view', component: PaymentSingle, name: 'viewPayment' },

            { path: 'users', component: UserList, name: 'users' },
            { path: 'users/create', component: UserCreate, name: 'createUser' },
            { path: 'users/:id/edit', component: UserEdit, name: 'editUser' },

            { path: 'coupons', component: CouponList, name: 'coupons' },
            { path: 'coupons/create', component: CouponCreate, name: 'createCoupon' },
            { path: 'coupons/:id/edit', component: CouponEdit, name: 'editCoupon' },

            { path: 'settings', component: Settings, name: 'settings' },
            { path: '*', component: NotFound },
        ]
    }
];

export default routes;

