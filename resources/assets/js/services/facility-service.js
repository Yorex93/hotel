import * as apiClient from "./api-client";
import { FACILITY_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function getFacilities(){
    let url = `${FACILITY_URLS.GET}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @param data
 * @return Promise
 */
function updateFacility(data){
    let url = `${FACILITY_URLS.GET}/${data.id}`;
    const { ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
}

/**
 *
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function createFacility(data){
    let url = `${FACILITY_URLS.GET}`;
    return apiClient.postForPromise(url, data);
}

/**
 *
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function deleteFacility(data){
    let url = `${FACILITY_URLS.GET}/${data.id}`;
    return apiClient.deleteForPromise(url);
}


export {
    getFacilities,
    createFacility,
    updateFacility,
    deleteFacility
}