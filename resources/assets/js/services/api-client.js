import axios from "axios";

/**
 *
 * @return {{}}
 */
function getRequestConfig({...additionalHeaders} = null) {
    let config = {};
    if(localStorage.getItem('token')){
        config.headers =  {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
            Accept: `application/json`,
          ...additionalHeaders
        };
    }
    return config;
}

function checkForUnauthorized(response){
    if([401, 403].includes(response.status)){
        localStorage.clear();
        window.location.reload(true);
    }
}

/**
 *
 * @param url
 * @return {Promise<AxiosResponse<any>>}
 */
function getForPromise(url){
    return axios.get(url, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        if(localStorage.getItem('token')) checkForUnauthorized(error.response);
        return Promise.reject(error);
    });
}

/**
 *
 * @param url
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function postForPromise(url, data){
    return axios.post(url, data, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        if(localStorage.getItem('token')) checkForUnauthorized(error.response);
        return Promise.reject(error);
    });
}

/**
 *
 * @param url
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function postFormData(url, data){
    return axios.post(url, data, getRequestConfig({ 'Content-Type': 'Multipart/formdata' })).then((response) => {
        return response;
    }).catch((error) => {
        if(localStorage.getItem('token')) checkForUnauthorized(error.response);
        return Promise.reject(error);
    });
}


/**
 *
 * @param url
 * @param data
 * @return {Promise<AxiosResponse<any>>}
 */
function putForPromise(url, data){
    return axios.put(url, data, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        if(localStorage.getItem('token')) checkForUnauthorized(error.response);
        return Promise.reject(error);
    });
}

/**
 *
 * @param url
 * @return {Promise<AxiosResponse<any>>}
 */
function deleteForPromise(url){
    return axios.delete(url, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        if(localStorage.getItem('token')) checkForUnauthorized(error.response);
        return Promise.reject(error);
    });
}


export {
    getForPromise,
    postForPromise,
    putForPromise,
    deleteForPromise,
    postFormData
}