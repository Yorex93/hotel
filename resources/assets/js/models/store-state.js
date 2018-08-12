export default {
    done : false,
    error : {},
    loading : false,
    data : [],

    mutate: function (type, value) {
        if(!type) return;

        switch(type){
            case 'DONE':
                this.done = value;
                break;

            case 'ERROR':
                this.error = value;
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

    generate(){
        return JSON.parse(JSON.stringify(this));
    }
}
