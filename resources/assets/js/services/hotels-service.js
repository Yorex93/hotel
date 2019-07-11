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
 * @param data
 * @return Promise
 */
function updateHotel(data){
    let url = `${HOTEL_URLS.GET}/${data.id}`;
    const { hotel, tags, facilities, media, services, rooms, room_types,  ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
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