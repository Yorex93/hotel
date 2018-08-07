import * as apiClient from "./api-client";
import { HOTEL_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function getHotels(){
    let url = `${HOTEL_URLS.GET}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @param hotelId
 * @param data
 * @return Promise
 */
function updateHotel(hotelId, data){
    let url = `${HOTEL_URLS.GET}/${hotelId}/update`;
    return apiClient.postForPromise(url, data);
}

/**
 *
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function createHotel(data){
    let url = `${HOTEL_URLS.GET}`;
    return apiClient.postForPromise(url, data);
}


export {
    getHotels,
    updateHotel,
    createHotel
}