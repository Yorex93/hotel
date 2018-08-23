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


Vue.component('Room', {
    props: ['room'],
    template: `<div class="room-block">
                <div class="room-img">
                  <img :src="getImageSrc(room.room_type.media[0])"/>
                 </div>
                <div class="room-details">
                  <h3>{{ room.room_type.title.toUpperCase() }}</h3>
                  <h4>{{ room.hotel.name.toUpperCase() }} {{ room.hotel.location ? '('+room.hotel.location.name+')' : '' }}</h4>
                  <h4><b style="color: green">&#8358;{{ getAmount(room.room_type.base_price_per_night) }}</b></h4>
                  <button class="btn btn-booking" style="margin-top: 0">Select</button>
                </div>
              </div>`,
    methods: {
        getImageSrc(image){
            if(image){
                return `${window.location.origin}/storage/${image.file}`
            }
            return '';
        },

        getAmount(amount){
            return parseInt(amount).toFixed(2).toString().replace(/(d)(?=(ddd)+(?!d))/g, "$1,");
        }
    }
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
            currentStage: 0,
            foundRooms: [],
            searched: false,
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
                specialRequest: '',
                days: 1
            },
            defaultReservation: {
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
                specialRequest: '',
                days : 1,
            },
            selectedRoom: {},
            errors: [],
            booking: {}
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

            if(queryParams['checkIn'] && queryParams['checkOut']){
                this.checkAvailability();
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

        resetData(){
            this.foundRooms = [];
            this.currentStage = 0;
            this.selectedRoom = {};
            this.reservation = Object.assign({}, this.defaultReservation);
        },

        checkAvailability(){
            this.resetData();
            this.loading = true;
            this.loadingMessage = 'Please wait while we look for available rooms';
            let url = `${window.location.origin}/api/v1/reservations/check?${this.getQueryString()}`;
            let self = this;
            fetch(url, this.fetchArgs).then(function (resp) {
                return resp.json();
            }).then(function (response) {
                self.searched = true;
                self.foundRooms = response.data;
                self.reservation.checkIn = moment(self.arrivalDate).valueOf();
                self.reservation.checkOut = moment(self.departureDate).valueOf();
                self.reservation.adults = self.adults;
                self.reservation.children = self.children;
                self.reservation.days = moment(self.reservation.checkOut).diff(moment(self.reservation.checkIn), 'days') + 1;
            }).catch(function(error){

            }).finally(function(){
                self.loading = false;
                self.loadingMessage = '';
            })
        },

        getDate(date){
            return moment(parseInt(date)).format('YYYY-MM-D');
        },

        getAmount(amount){
            return parseInt(amount).toFixed(2).toString().replace(/(d)(?=(ddd)+(?!d))/g, "$1,");
        },

        selectRoom(room){
            this.selectedRoom = room;
            this.currentStage = 1;
        },

        backTo(stage){
            this.currentStage = stage;
        },

        confirmation(){
            this.errors = [];
            if(!this.reservation.lastName.trim()){
                this.errors.push('Last name is required');
            }

            if(!this.reservation.firstName.trim()){
                this.errors.push('First name is required');
            }

            if(!this.reservation.email.trim()){
                this.errors.push('Email is required');
            }

            if(!this.reservation.phone.trim()){
                this.errors.push('Phone number is required');
            }

            if(this.errors.length > 0){
                return;
            }

            this.currentStage = 2;
        },

        goHome(){
            window.location = window.location.origin;
        },

        makeBooking(paymentMethod){
            this.loading = true;
            this.loadingMessage = "Kindly hold while we place your reservation..";
            const data = {
              ...this.reservation,
                roomId: this.selectedRoom.id,
                paymentMethod
            };

            let postObj = {
                method: "POST",
                  headers: {
                    "Content-Type": "application/json; charset=utf-8",
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                body: JSON.stringify(data)
            };

            let url = `${window.location.origin}/api/v1/reservations/make`;
            let self = this;
            fetch(url, postObj).then(function (resp) {
                return resp.json();
            }).then(function (response) {
                //console.log(response);
                self.booking = response.data;
                self.currentStage = 3;
            }).catch(function(error){
                //console.log(error);
            }).finally(function(){
                self.loading = false;
                self.loadingMessage = '';
            });
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
                            <div class="col-md-12 animated fadeIn" v-if="currentStage === 0">
                              <h2 v-if="getQueryParams()['checkIn'] || searched">{{ foundRooms.length }} room types found</h2>
                              <div v-if="foundRooms.length > 0">
                                <div class="col-md-6 col-sm-6 col-xs-12" v-for="room in foundRooms">
                                  <div class="room" @click="selectRoom(room)">
                                    <room :room="room"></room>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 animated fadeIn" v-if="currentStage === 1 && selectedRoom.id">
                                <div class="reservation__form-body">
                                    <p class="subheading">Booking form 
                                      <a @click.prevent="backTo(0)" style="cursor: pointer;letter-spacing: 0;">Back to room selection</a>
                                    </p>
                                    <h2 class="section__heading">Room info</h2>
                                    <table style="padding: 20px" border="1" cellpadding="5" cellspacing="5" class="room-selection">
                                      <tr>
                                        <td><h4>{{ selectedRoom.room_type.title.toUpperCase() }}</h4></td>
                                        <td><h4>{{ selectedRoom.hotel.name.toUpperCase() }} {{ selectedRoom.hotel.location ? '('+selectedRoom.hotel.location.name+')' : '' }}</h4></td>
                                        <td><h4><b style="color: green">&#8358;{{ getAmount(selectedRoom.room_type.base_price_per_night) }}</b>/night</h4></td>
                                      </tr>
                                    </table>
                                    <h2 class="section__heading">Personal info</h2>
                                            <!-- Alert message -->
                                    <div class="alert" id="form_reservation" role="alert"></div>
                                
                                      <form id="reservation-form_sendemail" class="reservation__form" data-animate-in="animateUp">
                                        <div class="alert alert-danger" v-if="errors.length > 0"><ul><li v-for="error in errors">{{ error }}</li></ul></div>
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
                                              <select class="form-control" name="form-adults" id="form-adults" v-model="reservation.adults" required>
                                                <option v-for="n in counters" :value="n">{{ n }} Adult{{ n === 1 ? '' : 's' }}</option>
                                              </select>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                              <label for="form-children" class="sr-only">Children</label>
                                              <select class="form-control" name="form-children" id="form-children" v-model="reservation.children" required>
                                                <option v-for="n in counters" :value="n">{{ n }} Child{{ n === 1 ? '' : 'ren' }}</option>
                                              </select>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="first-name" class="sr-only">First name</label>
                                              <input type="text" name="first-name" class="form-control" id="first-name" placeholder="First Name" v-model="reservation.firstName" required>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="last-name" class="sr-only">Last name</label>
                                              <input type="text" name="last-name" class="form-control" id="last-name" placeholder="Last Name" v-model="reservation.lastName" required>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="email" class="sr-only">Email</label>
                                              <input type="email" name="email" class="form-control" id="email" placeholder="Email" v-model="reservation.email" required>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                              <label for="phone" class="sr-only">Phone</label>
                                              <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" v-model="reservation.phone" required>
                                              <span class="help-block"></span>
                                            </div>
                                          </div>
                                          <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                              <label for="address-line1" class="sr-only">Address</label>
                                              <input type="text" name="address-line1" class="form-control" id="address-line1" placeholder="Address (optional)" v-model="reservation.address">
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
                                            <button type="submit" class="btn btn-booking" @click.prevent="confirmation">Book now</button>
                                        </div>
                                      </form> <!-- .reservation__form -->
                                    </div> <!-- .reservation__form-body -->
                                  </div>
                            <div class="col-md-12 animated fadeIn" v-if="currentStage === 2">
                                    <div class="confirm-booking reservation__form-body" style="overflow: hidden">
                                      <p class="subheading">Confirm Reservation
                                      <a @click.prevent="backTo(1)" style="cursor: pointer;letter-spacing: 0;">Back to form</a>
                                      </p>
                                      
                                      <table style="padding: 20px" border="1" cellpadding="5" cellspacing="5" class="room-selection">
                                      <tr>
                                        <td><h4>{{ selectedRoom.room_type.title.toUpperCase() }}</h4></td>
                                        <td><h4>{{ selectedRoom.hotel.name.toUpperCase() }} {{ selectedRoom.hotel.location ? '('+selectedRoom.hotel.location.name+')' : '' }}</h4></td>
                                        <td><h4><b style="color: green">&#8358;{{ getAmount(selectedRoom.room_type.base_price_per_night) }}</b>/night</h4></td>
                                      </tr>
                                    </table>
                                    
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">Check in</div>
                                        <div class="value">{{ getDate(reservation.checkIn) }}</div>
                                      </div>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">Check Out</div>
                                        <div class="value">{{ getDate(reservation.checkOut) }}</div>
                                      </div>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">Email</div>
                                        <div class="value">{{ reservation.email }}</div>
                                      </div>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">First Name</div>
                                        <div class="value">{{ reservation.firstName }}</div>
                                      </div>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">Last Name</div>
                                        <div class="value">{{ reservation.lastName }}</div>
                                      </div>
                                      
                                      <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="heading">Phone</div>
                                        <div class="value">{{ reservation.phone }}</div>
                                      </div>
                                      
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="heading">Address</div>
                                        <div class="value">{{ reservation.address || 'Not filled' }}</div>
                                      </div>
                                      
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="heading">Special Requirements</div>
                                        <div class="value">{{ reservation.specialRequest || 'NONE' }}</div>
                                      </div>
                                      
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="heading">Total Due</div>
                                        <div class="value amount">&#8358;{{ getAmount(parseInt(selectedRoom.room_type.base_price_per_night) * parseInt(reservation.days)) }}</div>
                                      </div>
                                      
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-booking" v-if="false">Pay Online Now</button>
                                        <button class="btn btn-booking" @click.prevent="makeBooking('LOCATION')">Pay at Location</button>
                                      </div>
                                    </div>
                                </div>
                                
                            <div class="col-md-12 animated fadeIn" v-if="currentStage === 3">
                              <div class="success" style="display: flex; flex-direction: column;align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 496.158 496.158" style="enable-background:new 0 0 496.158 496.158; width: 200px" xml:space="preserve">
                                            <path style="fill:#32BEA6;" d="M496.158,248.085c0-137.021-111.07-248.082-248.076-248.082C111.07,0.003,0,111.063,0,248.085  c0,137.002,111.07,248.07,248.082,248.07C385.088,496.155,496.158,385.087,496.158,248.085z"/>
                                            <path style="fill:#FFFFFF;" d="M384.673,164.968c-5.84-15.059-17.74-12.682-30.635-10.127c-7.701,1.605-41.953,11.631-96.148,68.777  c-22.49,23.717-37.326,42.625-47.094,57.045c-5.967-7.326-12.803-15.164-19.982-22.346c-22.078-22.072-46.699-37.23-47.734-37.867  c-10.332-6.316-23.82-3.066-30.154,7.258c-6.326,10.324-3.086,23.834,7.23,30.174c0.211,0.133,21.354,13.205,39.619,31.475  c18.627,18.629,35.504,43.822,35.67,
                                            44.066c4.109,6.178,11.008,9.783,18.266,9.783c1.246,0,2.504-0.105,3.756-0.322  c8.566-1.488,15.447-7.893,17.545-16.332c0.053-0.203,8.756-24.256,54.73-72.727c37.029-39.053,61.723-51.465,70.279-54.908  
                                            c0.082-0.014,0.141-0.02,0.252-0.043c-0.041,0.01,0.277-0.137,0.793-0.369c1.469-0.551,2.256-0.762,2.301-0.773  c-0.422,0.105-0.641,0.131-0.641,0.131l-0.014-0.076c3.959-1.727,11.371-4.916,11.533-4.984  
                                            C385.405,188.218,389.034,176.214,384.673,164.968z"/></svg>
                                 <h3>Your Reservation has been made</h3>
                                 <h4>Your booking ref is {{ booking.booking_ref }}</h4>  
                                 <button class="btn btn-booking" @click.prevent="goHome">Back to Home</button>         
                              </div>
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