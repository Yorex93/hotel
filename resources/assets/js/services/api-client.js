import axios from "axios";

/**
 *
 * @return {{}}
 */
function getRequestConfig() {
    let config = {};
    if(localStorage.getItem('token')){
        config.headers =  {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
            Accept: `application/json`
        };
    }
    return config;
}

function checkForUnauthorized(response){
    if([].includes(response.status)){
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
        checkForUnauthorized(error.response);
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
    });
}

export {
    getForPromise,
    postForPromise
}