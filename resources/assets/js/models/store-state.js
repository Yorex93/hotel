export default {
    done : false,
    error : {},
    errorMessage: "",
    loading : false,
    data : [],

    mutate: function (type, value) {
        if(!type) return;

        switch(type){
            case 'DONE':
                this.done = value;
                break;

            case 'ERROR':
                if(!value){
                    this.error = {};
                    this.errorMessage = "";
                    return;
                }

                if(Object.keys(value).length === 0){
                    this.error = {};
                    this.errorMessage = "";
                    return;
                }

                if (value.response) {
                    if(value.response.data){
                        this.error = value.response.data;
                        this.errorMessage = value.response.data.message
                    }
                }

                break;

            case 'LOADING':
                this.loading = value;
                break;

            case 'DATA':
                this.data = value;
                break;

            default:
                return;
        }
    },
}
