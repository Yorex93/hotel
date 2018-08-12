import * as apiClient from "./api-client";
import { HOTEL_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function getDemo(){
    let url = `${HOTEL_URLS.GET}`;
    return apiClient.getForPromise(url);
}

export {
    getDemo
}