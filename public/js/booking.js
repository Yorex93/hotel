// Vue.config.devtools = false;
// Vue.config.debug = false;
// Vue.config.silent = true;

Vue.component('HotelBooking', {
    components: {
        datepicker: vuejsDatepicker,
    },
    data: function () {
        return {
            count: 0,
            format: 'yyyy-MM-dd',
            adults: 1,
            children: 0,
            counters: [0,1,2,3,4,5],
            arrivalDate: new Date(),
            departureDate: new Date().setDate(new Date().getDate() + 1),
            disabledArrivalDates: {
                to: new Date(moment().subtract(1, 'day').format()),
            }

        }
    },

    computed: {
        disabledDepartureDates: function(){
            return {
                to: new Date(moment(this.arrivalDate).add(1, 'day').format()),
            }
        }
    },

    watch: {
        arrivalDate: function(newValue){
            if(moment(newValue) >= moment(this.departureDate)){
                this.departureDate = new Date(moment(newValue).add(1, 'day').format());
            }
        }
    },
    template: `<section class="booking__section">
                  <div class="container">
                    <div class="row booking-check-form">
                      <div class="col-md-3 col-sm-6 col-xs-6">
                          <div class="form-label">Check-in Date</div>
                          <datepicker v-model="arrivalDate" :format="format" :disabledDates="disabledArrivalDates"></datepicker>
                       </div>
                       <div class="col-md-3 col-sm-6 col-xs-6">
                          <div class="form-label">Check-out Date</div>
                          <datepicker v-model="departureDate" :format="format" :disabledDates="disabledDepartureDates"></datepicker>
                       </div>
                       <div class="col-md-2 col-sm-4 col-xs-6">
                          <div class="form-label">No. of Adults</div>
                          <select v-model="adults">
                            <option v-for="n in counters" :value="n">{{ n }} Adult{{ n === 1 ? '' : 's' }}</option>
                          </select>
                       </div>
                       <div class="col-md-2 col-sm-4 col-xs-6">
                          <div class="form-label">No. of Children</div>
                          <select v-model="children">
                            <option v-for="n in counters" :value="n">{{ n }} Child{{ n === 1 ? '' : 'ren' }}</option>
                          </select>
                       </div>
                       <div class="col-md-2 col-sm-4 col-xs-12">
                          <div class="form-label">&nbsp;</div>
                          <button class="btn btn-reservation" style="padding: 15px 20px; border-width: 2px">Check Rooms</button>
                       </div>
                    </div>
                  </div>
                </section>`,

});



const app = new Vue({
    el: '#booking-section',
    components: {
        vuejsDatepicker: window.vuejsDatepicker,
    },
    template: '<HotelBooking/>',
});