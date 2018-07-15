const SITE_URL = "http://127.0.0.1:8080";
const API_URL = `${SITE_URL}/api/v1`;

const AUTH_URLS = {
   LOGIN:  `${API_URL}/login`,
   LOGOUT: `${API_URL}/logout`,
};

export {
    SITE_URL,
    AUTH_URLS,
}