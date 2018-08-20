import * as apiClient from "./api-client";
import { HOTEL_SERVICES_URLS } from "../constants";

function getHotelServices(){
    return apiClient.getForPromise(HOTEL_SERVICES_URLS.GET);
}

function createHotelService(data){
    const url = `${HOTEL_SERVICES_URLS.GET}`;
    return apiClient.postForPromise(url, data);
}

function updateHotelService(id, data){
    const url = `${HOTEL_SERVICES_URLS.GET}/${id}`;
    let { children, parent_service,  ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
}

function deleteHotelService(id) {
    const url = `${HOTEL_SERVICES_URLS.GET}/${id}`;
    return apiClient.deleteForPromise(url);
}

function fetchParents() {
    const url = `${HOTEL_SERVICES_URLS.GET}?parents=true`;
    return apiClient.getForPromise(url);
}


export {
    getHotelServices,
    createHotelService,
    updateHotelService,
    deleteHotelService,
    fetchParents

}