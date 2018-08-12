import * as apiClient from "./api-client";
import { MEDIA_URLS } from "../constants";

/**
 *
 * @return Promise
 */
function deleteMedia(ids){
    let url = `${MEDIA_URLS.DELETE}`;
    return apiClient.postForPromise(url, { mediaIds: ids });
}

export {
    deleteMedia
}