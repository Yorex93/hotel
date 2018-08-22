// Vue.config.devtools = false;
// Vue.config.debug = false;
// Vue.config.silent = true;

Vue.component('loading', {
    props: ['message'],
    template: `<div class="loading animated fadeIn">
                      <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" 
                      preserveAspectRatio="xMidYMid" class="lds-ellipsis"><!--circle(cx="16",cy="50",r="10")-->
                      <circle cx="84" cy="50" r="0" fill="#71cc87"><animate attributeName="r" values="10;0;0;0;0" 
                      keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="0s"></animate>
                      <animate attributeName="cx" values="84;84;84;84;84" keyTimes="0;0.25;0.5;0.75;1" 
                      keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2.2s" 
                      repeatCount="indefinite" begin="0s"></animate></circle><circle cx="48.7397" cy="50" r="10" 
                      fill="#2f5046"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" 
                      keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2.2s" 
                      repeatCount="indefinite" begin="-1.1s"></animate><animate attributeName="cx" values="16;16;50;84;84" 
                      keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="-1.1s"></animate></circle>
                      <circle cx="16" cy="50" r="9.62931" fill="#deaa86"><animate attributeName="r" 
                      values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="-0.55s"></animate><animate attributeName="cx" 
                      values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="-0.55s"></animate></circle><circle cx="84" cy="50" r="0.370689" 
                      fill="#374853"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" 
                      keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2.2s" repeatCount="indefinite" 
                      begin="0s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" 
                      keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2.2s" repeatCount="indefinite" 
                      begin="0s"></animate></circle><circle cx="82.7397" cy="50" r="10" fill="#71cc87"><animate attributeName="r" 
                      values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" 
                      values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" 
                      calcMode="spline" dur="2.2s" repeatCount="indefinite" begin="0s"></animate></circle></svg>
                      <div>{{ message }}</div>
                       </div>`
});


Vue.component('HotelBooking', {
    components: {
        datepicker: vuejsDatepicker,

    },
    data: function () {
        return {
            count: 0,
            format: 'D d MMM',
            adults: 1,
            children: 0,
            counters: [0,1,2,3],
            arrivalDate: new Date(),
            departureDate: new Date(moment().add(1, 'day').format()),
            disabledArrivalDates: {
                to: new Date(moment().subtract(1, 'day').format()),
            },
            isReservation: false,
            loading: false,
            loadingMessage: '',
            fetchArgs: {
                method: "GET",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // "Content-Type": "application/x-www-form-urlencoded",
                },
            },
            stages: ['SELECT', 'DETAILS', 'CONFIRMATION', 'SUCCESS'],
            currentStage: 1,
            reservation: {
                checkIn: undefined,
                checkOut: undefined,
                adults: undefined,
                children: undefined,
                title: '',
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                address: '',
                specialRequest: ''
            }
        }
    },

    mounted: function() {
        if(window.location.pathname === '/reservations'){
            this.isReservation = true;
            const queryParams = this.getQueryParams();
            console.log(queryParams);
            if(queryParams['checkIn'] && !isNaN(parseInt(queryParams['checkIn']))){
                this.arrivalDate = new Date(parseInt(queryParams['checkIn']));
                this.reservation.checkIn = queryParams['checkIn'];
            }

            if(queryParams['checkOut'] && !isNaN(parseInt(queryParams['checkOut']))){
                this.departureDate = new Date(parseInt(queryParams['checkOut']));
                this.reservation.checkOut = queryParams['checkOut'];
            }

            if(queryParams['adults']){
                this.adults = queryParams['adults'];
                this.reservation.adults = queryParams['adults'];
            }

            if(queryParams['children']){
                this.children = queryParams['children'];
                this.reservation.children = queryParams['children'];
            }

            this.checkAvailability();
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
            if(moment(newValue).startOf('day').valueOf() >= moment(this.departureDate).startOf('day').valueOf()){
                this.departureDate = new Date(moment(newValue).add(1, 'day').format());
            }
        }
    },

    methods: {
        getQueryParams: function () {
            const search = location.search.substring(1);
            let queryParams = {};
            if(search){
                queryParams = JSON.parse('{"' + search.replace(/&/g, '","').replace(/=/g,'":"') + '"}',
                  function(key, value) { return key===""?value:decodeURIComponent(value) });
            }
            return queryParams;
        },

        submitSearch(){
            const baseUrl = window.location.origin;
            if(!this.isReservation){
                window.location =
                  `${baseUrl}/reservations?${this.getQueryString()}`;
                return;
            }
            this.checkAvailability();
        },

        getQueryString(){
           return `checkIn=${moment(this.arrivalDate).valueOf()}&checkOut=${moment(this.departureDate).valueOf()}&adults=${this.adults}&children=${this.children}`;
        },

        checkAvailability(){
            this.loading = true;
            this.loadingMessage = 'Please wait while we look for available rooms';
            let url = `${window.location.origin}/api/v1/reservations/check?${this.getQueryString()}`;
            let self = this;
            fetch(url, this.fetchArgs).then(function (resp) {
                return resp.json();
            }).then(function (response) {
                let data = response.data;

            }).catch(function(error){

            }).finally(function(){
                self.loading = false;
                self.loadingMessage = '';
            })
        },
        getDate(date){
            return moment(parseInt(date)).format('YYYY-MM-D');
        }
    },

    template: `<div>
                    <section class="booking__section">
                      <div class="container">
                        <div class="row booking-check-form">
                          <div class="col-md-3 col-sm-6 col-xs-12">
                              <div class="form-label">Check-in Date</div>
                              <datepicker v-model="arrivalDate" :format="format" :disabledDates="disabledArrivalDates"></datepicker>
                           </div>
                           <div class="col-md-3 col-sm-6 col-xs-12">
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
                              <button class="btn btn-reservation" style="padding: 15px 20px; border-width: 2px" @click.prevent="submitSearch">Check Rooms</button>
                           </div>
                        </div>
                      </div>
                    </section>
                   
                    <section class="section__reservation" v-if="isReservation" style="position: relative">
                     <loading v-if="loading" :message="loadingMessage"></loading>
    	                <div class="container">
                          <div class="row">
                            <div class="col-sm-12 animated fadeIn" v-if="currentStage === 1">
                                <div class="reservation__form-body">
                                    <p class="subheading">Booking form</p>
                                    <h2 class="section__heading">Personal info</h2>
                                            <!-- Alert message -->
                                    <div class="alert" id="form_reservation" role="alert"></div>
                                
                                      <form id="reservation-form_sendemail" class="reservation__form" data-animate-in="animateUp">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="check-in" class="sr-only">Check In date</label>
                                              <input type="date" name="check-in" class="form-control" id="check-in" :value="getDate(reservation.checkIn)" readonly>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="check-out" class="sr-only">Check Out date</label>
                                              <input type="date" name="check-in" class="form-control" id="check-out" :value="getDate(reservation.checkOut)" readonly>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="form-adults" class="sr-only">Adults</label>
                                              <select class="form-control" name="form-adults" id="form-adults" v-model="reservation.adults">
                                                <option v-for="n in counters" :value="n">{{ n }} Adult{{ n === 1 ? '' : 's' }}</option>
                                              </select>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="form-children" class="sr-only">Children</label>
                                              <select class="form-control" name="form-children" id="form-children" v-model="reservation.children">
                                                <option v-for="n in counters" :value="n">{{ n }} Child{{ n === 1 ? '' : 'ren' }}</option>
                                              </select>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="first-name" class="sr-only">First name</label>
                                              <input type="text" name="first-name" class="form-control" id="first-name" placeholder="First Name" v-model="reservation.firstName">
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="last-name" class="sr-only">Last name</label>
                                              <input type="text" name="last-name" class="form-control" id="last-name" placeholder="Last Name" v-model="reservation.lastName">
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="email" class="sr-only">Email</label>
                                              <input type="email" name="email" class="form-control" id="email" placeholder="Email" v-model="reservation.email">
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="phone" class="sr-only">Phone</label>
                                              <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" v-model="reservation.phone">
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                              <label for="address-line1" class="sr-only">Address</label>
                                              <input type="text" name="address-line1" class="form-control" id="address-line1" placeholder="Address line" v-model="reservation.address">
                                              <span class="help-block"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                              <label for="requirements" class="sr-only">Special requirements</label>
                                              <textarea name="requirements" class="form-control" rows="8" id="requirements" placeholder="Special requirements" v-model="reservation.specialRequest"></textarea>
                                              <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <p>
                                                <input type="checkbox" name="checkbox"> I have read and accept <a href="#" class="conditions">the terms and conditions.</a>
                                            </p>
                                            <button type="submit" class="btn btn-booking">Book now</button>
                                        </div>
                                      </form> <!-- .reservation__form -->
                                    </div> <!-- .reservation__form-body -->
                                  </div>
                            <div class="col-md-12 animated fadeIn" v-if="currentStage === 2">
                                <div class="booking__details-body">
                                    <p class="subheading">Booking details</p>
                                    <h2 class="section__heading">Selected room</h2>
                                    <figure class="room__details">
                                        <img src="assets/img/gallery_img1.jpg" class="img-responsive" alt="...">
                                        <figcaption>
                                            <h3>Double room</h3>
                                            <div class="room__price">
                                                $50 <small>/ night</small>
                                            </div>
                                            <p class="room__desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis mollitia voluptas vero vel eligendi sint.</p>
                                        </figcaption>
                                    </figure> <!-- / .room__details -->
                                    <ul class="details-info">
                                    <li>
                                      <label>Check in</label>
                                      <p>2017-04-09</p>
                                    </li>
                                    <li>
                                      <label>Check out</label>
                                      <p>2017-04-18</p>
                                    </li>
                                    <li>
                                      <label>Adults</label>
                                      <p>2 Person</p>
                                    </li>
                                    <li>
                                      <label>Children</label>
                                      <p>1 Chind</p>
                                    </li>
                                    <li>
                                      <label>Nights</label>
                                      <p>9 Nights</p>
                                    </li>
                                    <li>
                                      <label>Services</label>
                                      <p>$ 65</p>
                                    </li>
                                    <li class="total-price">
                                      <label>Total price</label>
                                      <p>$ 515</p>
                                    </li>
                                  </ul>
                                </div> <!-- .booking__details-body -->
                                <div class="info__body">
                                    <p class="info__title">Information</p>
                                    <ul class="info__content">
                                <li>
                                  <p class="info-text">If you have some questions with booking please contact us.</p>
                                </li>
                                  <li>
                                    <i class="icon ion-android-pin"></i>
                                    <div class="info-content">
                                      <div class="title">Address</div>
                                      <div class="description">10987 1st Avenue, Lorem City, CA</div>
                                    </div>
                                  </li>
                                  <li>
                                    <i class="icon ion-android-call"></i>
                                    <div class="info-content">
                                      <div class="title">Phone / Fax</div>
                                      <div class="description">+45 789 123 4544 / +45 789 123 4848</div>
                                    </div>
                                  </li>
                                  <li>
                                    <i class="icon ion-android-mail"></i>
                                    <div class="info-content">
                                      <div class="title">E-mail</div>
                                      <div class="description">admin@sunsethotel.com</div>
                                    </div>
                                  </li>
                                </ul> <!-- .info__content -->
                                </div> <!-- / .info__body -->
                            </div>
                          </div> <!-- / .row -->
                        </div> <!-- / .container -->
                    </section>
                </div>`,

});



const app = new Vue({
    el: '#booking-section',
    components: {
        vuejsDatepicker: window.vuejsDatepicker,
    },
    template: '<HotelBooking/>',
});