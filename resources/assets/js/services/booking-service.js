import * as apiClient from "./api-client";
import { BOOKING_URLS } from "../constants";
import { getQueryStringFromObject } from "./helpers";


/**
 *
 * @return Promise
 */
function getBookings(data){
    let url = `${BOOKING_URLS.GET}?${getQueryStringFromObject(data)}`;
    return apiClient.getForPromise(url);
}

export {
    getBookings
}