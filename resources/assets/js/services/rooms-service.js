import * as apiClient from "./api-client";
import { ROOM_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function getRoomTypes(){
    let url = `${ROOM_URLS.ROOM_TYPE}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @return Promise
 */
function createRoomType(data){
    let url = `${ROOM_URLS.ROOM_TYPE}`;
    return apiClient.postForPromise(url, data);
}

/**
 *
 * @return Promise
 */
function updateRoomType(id, data){
    let url = `${ROOM_URLS.ROOM_TYPE}/${id}`;
    const { hotel, tags, facilities, media, services, rooms,  ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
}

/**
 *
 * @return Promise
 */
function deleteRoomType(id){
    let url = `${ROOM_URLS.ROOM_TYPE}/${id}`;
    return apiClient.deleteForPromise(url);
}


/**
 *
 * @return Promise
 */
function getRooms(){
    let url = `${ROOM_URLS.ROOM}`;
    return apiClient.getForPromise(url);
}

/**
 *
 * @return {Promise<AxiosResponse<any>>}
 */
function createRooms(data){
    let url = `${ROOM_URLS.CREATE_ROOMS}`;
    let postObject = {
        hotel_id: data.hotelId,
        room_type_id: data.roomTypeId,
        count: data.count,
        start: data.start,
        prefix: data.prefix
    };
    return apiClient.postForPromise(url, postObject);
}

/**
 *
 * @return Promise
 */
function updateRoom(roomId, data){
    let url = `${ROOM_URLS.ROOM}/${roomId}/update`;
    return apiClient.putForPromise(url, data);
}

/**
 *
 * @return Promise
 */
function deleteRooms(roomIds){
    let url = `${ROOM_URLS.ROOM}-deleteAll`;
    let data = { roomIds };
    return apiClient.postForPromise(url, data);
}


export {
    getRoomTypes,
    createRoomType,
    updateRoomType,
    deleteRoomType,
    getRooms,
    createRooms,
    deleteRooms,
    updateRoom
}