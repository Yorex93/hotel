import * as apiClient from "./api-client";
import { LOCATION_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function getLocations(){
    let url = `${LOCATION_URLS.GET}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @return Promise
 */
function createLocationForHotel(data){
    let url = `${LOCATION_URLS.GET}`;
    return apiClient.postForPromise(url, data);
}

/**
 *
 * @return Promise
 */
function updateLocationForHotel(data){
    let url = `${LOCATION_URLS.GET}/${data.id}`;
    return apiClient.putForPromise(url, data);
}

/**
 *
 * @return Promise
 */
function getCountries(){
    let url = `${LOCATION_URLS.COUNTRIES}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @return Promise
 */
function getStatesForCountry(countryId){
    let url = `${LOCATION_URLS.COUNTRIES}/${countryId}/states`;
    return apiClient.getForPromise(url);
}

export {
    getLocations,
    getCountries,
    getStatesForCountry,
    updateLocationForHotel,
    createLocationForHotel
}