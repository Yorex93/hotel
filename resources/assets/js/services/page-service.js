import * as apiClient from "./api-client";
import { PAGE_URLS } from "../constants";

function getPages(){
    return apiClient.getForPromise(PAGE_URLS.PAGE);
}

function updatePage(id, data){
    const url = `${PAGE_URLS.PAGE}/${id}`;
    const { page_items,  ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
}


function getPageItems(){
    return apiClient.getForPromise(PAGE_URLS.PAGE_ITEMS);
}

function updatePageItem(id, data){
    const url = `${PAGE_URLS.PAGE_ITEMS}/${id}`;
    const { page,  ...postObject } = data;
    return apiClient.putForPromise(url, postObject);
}

export {
    getPageItems,
    updatePage,
    getPages,
    updatePageItem
}