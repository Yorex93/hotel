let SITE_URL = "https://hotelvaleriesuitesng.com";
//SITE_URL = "http://127.0.0.1:8000";

const API_URL = `${SITE_URL}/api/v1`;

const AUTH_URLS = {
   LOGIN:  `${API_URL}/login`,
   LOGOUT: `${API_URL}/logout`,
};

const HOTEL_URLS = {
    GET: `${API_URL}/hotels`,
};

const LOCATION_URLS = {
    GET: `${API_URL}/locations`,
    COUNTRIES: `${API_URL}/countries`,
};

const MEDIA_URLS = {
    DELETE: `${API_URL}/media/deleteAll`,
    GET: `${API_URL}/media`,
};

const ROOM_URLS = {
    ROOM_TYPE: `${API_URL}/roomTypes`,
    CREATE_ROOMS: `${API_URL}/roomTypes/createRooms`,
    ROOM: `${API_URL}/rooms`,
};

const FACILITY_URLS = {
    GET: `${API_URL}/facilities`,
};

const PAGE_URLS = {
    PAGE: `${API_URL}/pages`,
    PAGE_ITEMS: `${API_URL}/pageItems`,
};

const HOTEL_SERVICES_URLS = {
    GET: `${API_URL}/hotelServices`,
};

const BOOKING_URLS = {
    GET: `${API_URL}/bookings`,
};


export {
    SITE_URL,
    AUTH_URLS,
    HOTEL_URLS,
    LOCATION_URLS,
    MEDIA_URLS,
    ROOM_URLS,
    FACILITY_URLS,
    PAGE_URLS,
    HOTEL_SERVICES_URLS,
    BOOKING_URLS
}