const SITE_URL = "http://127.0.0.1:8000";
const API_URL = `${SITE_URL}/api/v1`;

const AUTH_URLS = {
   LOGIN:  `${API_URL}/login`,
   LOGOUT: `${API_URL}/logout`,
};

const HOTEL_URLS = {
    GET: `${API_URL}/hotels`,
};

export {
    SITE_URL,
    AUTH_URLS,
    HOTEL_URLS
}