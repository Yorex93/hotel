import moment from 'moment';
import currencies from "../constants/currencies.json";
import { SITE_URL } from "../constants"

let currencyArray = Object.values(currencies);

function getCurrencyObject(currency){
    return currencyArray.find(c => c.iso.code === currency || c.iso.number === currency);
}

function getQueryParams(){
    const search = location.search.substring(1);
    let queryParams = {};
    if(search){
        queryParams = JSON.parse('{"' + search.replace(/&/g, '","').replace(/=/g,'":"') + '"}',
            function(key, value) { return key===""?value:decodeURIComponent(value) });
    }
    return queryParams;
}

let dateHelpers = {
    dateForHumans(date, type = 'DT'){
        if(type === 'DT'){
            return moment(date).format('Do MMM, YYYY hh:mma');
        }

        if(type === 'D'){
            return moment(date).format('Do MMM, YYYY');
        }

        return '';
    }
};

let currencyFilters = {
    formatCurrency(value, currency = "NGN"){
        let html = '';
        let curr = getCurrencyObject(currency);
        if(curr !== undefined) {
            try {
                html = `${curr.units.major.symbol}`;
            } catch (e) {

            }
        }
        return `${html}${value !== null ? parseInt(value).toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") : ''}`;
    }
};

let urlResolvers = {
    getImage(location){
        return `${SITE_URL}/storage/${location}`;
    }
};

let fileResolvers = {
    isImage(media){
        if(media.mime_type){
            return !!media.mime_type.match(/image/);
        }
        return false
    },
};


export {
    getQueryParams,
    dateHelpers,
    currencyFilters,
    urlResolvers,
    fileResolvers
}