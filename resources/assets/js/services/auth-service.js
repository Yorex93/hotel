import * as apiClient from "./api-client";
import { AUTH_URLS } from "../constants";


/**
 *
 * @param email
 * @param password
 *
 * @return Promise<any>
 */
function login(email, password) {
    let data = {
        email,
        password
    };
    return apiClient.postForPromise(AUTH_URLS.LOGIN, data);
}


function logout() {
    return apiClient.postForPromise(AUTH_URLS.LOGOUT);
}

export {
    login, logout
}