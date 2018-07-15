import axios from "axios";


function getRequestConfig() {
    let config = {};
    if(localStorage.getItem('token')){
        config.headers =  { Authorization: `Bearer ${localStorage.getItem('token')}` };
    }
    return config;
}

function checkForUnauthorized(response){
    if(response.status === 401){
        localStorage.clear();
        window.location.reload(true);
    }
}

function getForPromise(url){
    return axios.get(url, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        checkForUnauthorized(error.response);
    });
}


function postForPromise(url, data){
    return axios.post(url, data, getRequestConfig()).then((response) => {
        return response;
    }).catch((error) => {
        checkForUnauthorized(error.response);
    });
}

export {
    getForPromise,
    postForPromise
}