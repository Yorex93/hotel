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
    let url = `${ROOM_URLS.ROOM_TYPE}/${id}/update`;
    return apiClient.putForPromise(url, data);
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
 * @return Promise
 */
function createRoom(hotelId, roomTypeId, roomCount){
    let url = `${ROOM_URLS.ROOM}`;
    let data = {
        hotelId, roomTypeId, roomCount
    };
    return apiClient.postForPromise(url, data);
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
    createRoom,
    deleteRooms,
    updateRoom
}