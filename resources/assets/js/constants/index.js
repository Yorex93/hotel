const SITE_URL = "http://hotelvaleriesuitesng.com";
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
    ROOM: `${API_URL}/rooms`,
};

export {
    SITE_URL,
    AUTH_URLS,
    HOTEL_URLS,
    LOCATION_URLS,
    MEDIA_URLS,
    ROOM_URLS
}