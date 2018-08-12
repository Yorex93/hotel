<template>
  <div>
    <h2 class="primary-text mb-3">
      Editing Hotel
      <span class="teal--text"> {{ hotel.name }}</span>
    </h2>

    <v-tabs
        color="cyan"
        dark
        slider-color="red"
        v-model="tabs"
        show-arrows
    >
      <v-tab ripple target="hotel-details">Hotel Details</v-tab>
      <v-tab ripple target="location-details">Location Details</v-tab>
      <v-tab ripple target="hotel-media">Media</v-tab>
      <v-tab ripple target="hotel-facilities">Facilities</v-tab>

      <v-tab-item id="hotel-details">
        <v-alert
            :value="hotelErrors"
            color="error"
            icon="warning"
            dismissible
            outline
            transition="scale-transition"
        >
         {{ hotelErrors }}
        </v-alert>

        <v-form v-model="valid">
          <v-container>
        <v-layout row wrap>
          <v-flex xs12 sm6>
            <v-text-field
                    v-model="hotel.name"
                    label="Hotel Name"
                    required
                    :error-messages = "hotelNameErrors"
                    @input="$v.hotel.name.$touch()"
                    @blur="$v.hotel.name.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
                    v-model="hotel.sub_title"
                    label="Sub Title"
                    required
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm12>
            <vue-editor v-model="hotel.description" placeholder="Enter hotel description"/>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
                    v-model="hotel.email"
                    label="Email"
                    required
                    :error-messages = "hotelEmailErrors"
                    @input="$v.hotel.email.$touch()"
                    @blur="$v.hotel.email.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
                    v-model="hotel.phone"
                    label="Phone"
                    required
                    :error-messages = "hotelPhoneErrors"
                    @input="$v.hotel.phone.$touch()"
                    @blur="$v.hotel.phone.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
                    v-model="hotel.website"
                    label="Website (optional)"
                    required
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-select
                    :items="eligibleParentHotels"
                    label="Select Parent hotel (optional)"
                    item-text="name"
                    item-value="id"
                    v-model="hotel.parent_hotel_id"
            ></v-select>
          </v-flex>

          <v-btn :disabled="!valid" @click.prevent="submit">
            submit
          </v-btn>
        </v-layout>
      </v-container>
        </v-form>
      </v-tab-item>

      <v-tab-item id="location-details">
        <v-alert
                :value="locationErrors"
                color="error"
                icon="warning"
                dismissible
                outline
                transition="scale-transition"
        >
          {{ locationErrors }}
        </v-alert>
        <v-form v-model="validLocation">
          <v-container>
            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-text-field
                    v-model="location.name"
                    label="Location Name"
                    required
                    :error-messages = "locationNameErrors"
                    @input="$v.location.name.$touch()"
                    @blur="$v.location.name.$touch()"
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="location.city"
                        label="City"
                        required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm12>
                <v-text-field
                        v-model="location.address"
                        label="Address"
                        required
                        :error-messages = "locationAddressErrors"
                        @input="$v.location.address.$touch()"
                        @blur="$v.location.address.$touch()"
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-autocomplete
                        :items="countries"
                        label="Select Country"
                        item-text="name"
                        item-value="id"
                        v-model="location.country_id"
                        :error-messages="locationCountryErrors"
                        @input="$v.location.country_id.$touch()"
                        @blur="$v.location.country_id.$touch()"
                        :search-input.sync="searchCountries"
                />
              </v-flex>

              <v-flex xs12 sm6>
                <v-autocomplete
                        :items="states"
                        label="Select State"
                        item-text="name"
                        item-value="id"
                        v-model="location.state_id"
                        :error-messages="locationStateErrors"
                        @input="$v.location.state_id.$touch()"
                        @blur="$v.location.state_id.$touch()"
                        :loading="statesLoading"
                        :search-input.sync="searchStates"
                />
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="location.email"
                        label="Email"
                        required
                        :error-messages = "locationEmailErrors"
                        @input="$v.location.email.$touch()"
                        @blur="$v.location.email.$touch()"
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="location.phone"
                        label="Phone"
                        required
                        :error-messages = "locationPhoneErrors"
                        @input="$v.location.phone.$touch()"
                        @blur="$v.location.phone.$touch()"
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                  v-model="location.latitude"
                  label="Latitude"
                  >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                    v-model="location.longitude"
                    label="Longitude"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-divider></v-divider>
              </v-flex>

              <v-flex xs12>
                <h3>Contact Person Detail</h3>
              </v-flex>

              <v-flex xs12 sm3 md3>
                <v-text-field
                    v-model="location.contact_person.title"
                    label="Title (optional)"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm3 md3>
                <v-text-field
                        v-model="location.contact_person.last_name"
                        label="Surname"
                        :error-messages="contactSurnameError"
                        @input="$v.location.contact_person.last_name.$touch()"
                        @blur="$v.location.contact_person.last_name.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm3 md3>
                <v-text-field
                        v-model="location.contact_person.first_name"
                        label="First Name"
                        :error-messages="contactFirstNameError"
                        @input="$v.location.contact_person.first_name.$touch()"
                        @blur="$v.location.contact_person.first_name.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm3 md3>
                <v-text-field
                        v-model="location.contact_person.middle_name"
                        label="Middle Name (optional)"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="location.contact_person.phone_number"
                        label="Phone Number"
                        :error-messages="contactPhoneError"
                        @input="$v.location.contact_person.phone_number.$touch()"
                        @blur="$v.location.contact_person.phone_number.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="location.contact_person.email"
                        label="Email (optional)"
                        :error-messages="contactEmailError"
                        @input="$v.location.contact_person.email.$touch()"
                        @blur="$v.location.contact_person.email.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-btn :disabled="!validLocation" @click.prevent="submitLocation">Save</v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-form>
      </v-tab-item>

      <v-tab-item id="hotel-media">
        <media-list
                :media="hotel.media"
                :allow-upload="true"
                :max-allowed-upload="10"
                :allow-delete="true"
                :upload-link="uploadLink"
                v-on:media-uploaded="uploadedMedia($event)"
                v-on:media-deleted="fetchHotels"
        />
      </v-tab-item>

      <v-tab-item id="hotel-facilities">
        <facilities-list
            :facilities="hotel.facilities"
            :can-modify="true"
            v-on:sycn-facilities="syncFacilities($event)"/>
      </v-tab-item>
    </v-tabs>

    <v-dialog
        v-model="isUpdatingHotel"
        hide-overlay
        persistent
        width="300"
    >
      <v-card
        color="green"
        dark
      >
        <v-card-text>
          Updating Hotel
          <v-progress-linear
              indeterminate
              color="white"
              class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="isUpdatingLocation"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="green"
              dark
      >
        <v-card-text>
          Updating Location ...
          <v-progress-linear
                  indeterminate
                  color="white"
                  class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="isCreatingLocation"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="yellow"
              dark
      >
        <v-card-text>
          Creating Location ...
          <v-progress-linear
                  indeterminate
                  color="white"
                  class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

  <script>
      import {mapActions, mapGetters} from 'vuex';
      import * as locationService from '../../services/location-service';
      import { HOTEL_URLS } from '../../constants';
      import { required, email, minLength } from 'vuelidate/lib/validators'
      import MediaList from "../media/MediaList";
      import HotelFacility from "./HotelFacility";
      import { VueEditor } from 'vue2-editor'

      export default {
          name: 'HotelEdit',
          components: {
              'media-list': MediaList,
              'facilities-list': HotelFacility,
              'vue-editor': VueEditor
          },
          data: () => ({
              valid: true,
              validLocation: true,
              hotelErrors: '',
              locationErrors: '',
              states: [],
              statesLoading: false,
              searchStates: "",
              searchCountries: "",
              tabs: "",
              hotel: {
                  id: undefined,
                  name: '',
                  sub_title: '',
                  description: '',
                  email: '',
                  phone: '',
                  website: '',
                  parent_hotel_id: '',
                  media: [],
                  facilities: [],
              },
              location: {
                  id: undefined,
                  name: '',
                  address: '',
                  city: '',
                  phone: '',
                  email: '',
                  state_id: undefined,
                  country_id: undefined,
                  latitude: '',
                  longitude: '',
                  contact_person: {
                      id: undefined,
                      email: '',
                      first_name: '',
                      middle_name: '',
                      last_name: '',
                      phone_number: '',
                      title: '',
                      is_public: false
                  }
              },

          }),

          validations: {
              hotel: {
                  name: {
                      required,
                      minLength: minLength(4)
                  },
                  description: {
                      required,
                      minLength: minLength(100)
                  },
                  email: {
                      required,
                      email
                  },
                  phone: {
                      required
                  }
              },

              location: {
                  name: {
                      required,
                      minLength: minLength(4)
                  },
                  address: {
                      required,
                  },
                  email: {
                      required,
                      email
                  },
                  phone: {
                      required
                  },
                  country_id: {
                      required,
                  },
                  state_id: {
                      required,
                  },

                  contact_person: {
                      first_name: { required },
                      last_name: { required },
                      phone_number: { required },
                      email: { email },
                  }
              }
          },

          methods: {
              ...mapActions('hotel', ['updateHotel', 'clearHotelComponentData', 'fetchHotels']),
              ...mapActions('location', ['createLocation', 'updateLocation', 'clearLocationComponentData']),

              submit(){
                  this.$v.$touch();
                  console.log(this.$v);
                  if(!this.$v.hotel.$invalid){
                      this.updateHotel(this.hotel);
                  }
              },

              submitLocation(){
                  this.$v.$touch();
                  console.log(this.$v);

                  if(!this.$v.location.$invalid){
                      if(this.location.id === undefined){
                          this.createLocation({ ...this.location , hotel_id: this.hotel.id });
                      } else {
                          this.updateLocation(this.location);
                      }

                  }
              },

              loadHotel(){
                  let hotel = this.getHotelById(this.$route.params.id);
                  if(hotel === undefined){
                      this.$router.push({ name: 'hotels' });
                  } else {
                      hotel = JSON.parse(JSON.stringify(hotel));
                      this.hotel = hotel;
                      if(hotel.location){
                          this.location = hotel.location;
                          this.fetchStates(hotel.location.country_id);
                      }
                  }
              },

              fetchStates(countryId){
                  this.statesLoading = true;
                  locationService.getStatesForCountry(countryId).then(resp => {
                      let result = resp.data;
                      this.states = result.data;
                  }).catch(error => {

                  }).finally(() => {
                      this.statesLoading = false;
                  })
              },

              uploadedMedia(files){
                  this.$toastr.s("Files uploaded successfully");
                  this.fetchHotels();
              },

              syncFacilities(facilities){
                  console.log(facilities)
              },
          },

          computed: {
              ...mapGetters('hotel',
                ['getHotelById', 'getHotels', 'getEligibleParentHotels', 'isUpdatingHotel', 'updatingHotelError', 'updatedHotel']
              ),
              ...mapGetters('location',
                ['countries', 'createdLocation', 'updatedLocation', 'isCreatingLocation', 'isUpdatingLocation', 'creatingLocationError', 'updatingLocationError']),
              hotelNameErrors () {
                  const errors = [];
                  if (!this.$v.hotel.name.$dirty) return errors;
                  !this.$v.hotel.name.required && errors.push('You must enter a hotel name');
                  !this.$v.hotel.name.minLength && errors.push(`Name must be at least ${this.$v.hotel.name.$params.minLength.min} characters`);
                  return errors
              },
              hotelDescriptionErrors () {
                  const errors = [];
                  if (!this.$v.hotel.description.$dirty) return errors;
                  !this.$v.hotel.description.required && errors.push('You describe hotel in a few words :)');
                  !this.$v.hotel.description.minLength && errors.push(`Name must be at least ${this.$v.hotel.description.$params.minLength.min} characters`);
                  return errors
              },

              hotelEmailErrors () {
                  const errors = [];
                  if (!this.$v.hotel.email.$dirty) return errors;
                  !this.$v.hotel.email.required && errors.push('Please enter hotel contact email address');
                  !this.$v.hotel.email.email && errors.push(`Please enter a valid email address`);
                  return errors
              },

              hotelPhoneErrors () {
                  const errors = [];
                  if (!this.$v.hotel.phone.$dirty) return errors;
                  !this.$v.hotel.phone.required && errors.push('You enter hotel contact phone number');
                  return errors
              },

              locationNameErrors () {
                  const errors = [];
                  if (!this.$v.location.name.$dirty) return errors;
                  !this.$v.location.name.required && errors.push('You must enter a location name');
                  !this.$v.location.name.minLength && errors.push(`Name must be at least ${this.$v.location.name.$params.minLength.min} characters`);
                  return errors
              },
              locationAddressErrors () {
                  const errors = [];
                  if (!this.$v.location.address.$dirty) return errors;
                  !this.$v.location.address.required && errors.push('Enter address of this location');
                  return errors
              },

              locationEmailErrors () {
                  const errors = [];
                  if (!this.$v.location.email.$dirty) return errors;
                  !this.$v.location.email.required && errors.push('You enter location contact email address');
                  !this.$v.location.email.email && errors.push(`Please enter a valid email address`);
                  return errors
              },

              locationPhoneErrors () {
                  const errors = [];
                  if (!this.$v.location.phone.$dirty) return errors;
                  !this.$v.location.phone.required && errors.push('You enter location contact phone number');
                  return errors
              },

              locationCountryErrors(){
                  const errors = [];
                  if (!this.$v.location.country_id.$dirty) return errors;
                  !this.$v.location.country_id.required && errors.push('Please select a country');
                  return errors;
              },

              locationStateErrors(){
                  const errors = [];
                  if (!this.$v.location.state_id.$dirty) return errors;
                  !this.$v.location.state_id.required && errors.push('Please select a state');
                  return errors;
              },

              contactSurnameError(){
                  const errors = [];
                  if (!this.$v.location.contact_person.last_name.$dirty) return errors;
                  !this.$v.location.contact_person.last_name.required && errors.push('Please enter surname');
                  return errors;
              },

              contactFirstNameError(){
                  const errors = [];
                  if (!this.$v.location.contact_person.first_name.$dirty) return errors;
                  !this.$v.location.contact_person.first_name.required && errors.push('Please enter first name');
                  return errors;
              },

              contactPhoneError(){
                  const errors = [];
                  if (!this.$v.location.contact_person.phone_number.$dirty) return errors;
                  !this.$v.location.contact_person.phone_number.required && errors.push('Please enter phone number');
                  return errors;
              },

              contactEmailError(){
                  const errors = [];
                  if (!this.$v.location.contact_person.email.$dirty) return errors;
                  !this.$v.location.contact_person.email.email && errors.push('Please enter valid email address');
                  return errors;
              },


              eligibleParentHotels(){
                  return this.getEligibleParentHotels.filter(h => h.id !== this.$route.params.id);
              },

              country_id(){
                  return this.location.country_id;
              },

              uploadLink(){
                  return `${HOTEL_URLS.GET}/${this.hotel ? this.hotel.id : ''}/addMedia`;
              }
          },

          mounted() {
              if (this.$route.params.id) {
                  this.loadHotel();
              }
          },

          watch: {
              updatingHotelError(value){
                  if(typeof value === 'string'){
                      this.hotelErrors = value;
                  } else {
                      if(Object.keys(value).length > 0){
                          this.hotelErrors = "You form submission has errors";
                      }
                  }
              },

              creatingLocationError(value){
                  if(typeof value === 'string'){
                      this.locationErrors = value;
                  } else {
                      if(Object.keys(value).length > 0){
                          this.locationErrors = "You form submission has errors";
                      }
                  }
              },

              updatingLocationError(value){
                  if(typeof value === 'string'){
                      this.locationErrors = value;
                  } else {
                      if(Object.keys(value).length > 0){
                          this.locationErrors = "You form submission has errors";
                      }
                  }
              },

              updatedHotel(value){
                  if(value){
                      this.$toastr.s("Hotel Updated Successfully");
                      //this.loadHotel();
                  }
              },

              createdLocation(value){
                  if(value){
                      this.$toastr.s("Location created Successfully");
                  }
              },

              updatedLocation(value){
                  if(value){
                      this.$toastr.s("Location updated Successfully");
                  }
              },

              country_id(newValue, oldValue){
                  if(newValue !== oldValue){
                      this.fetchStates(newValue);
                  }
              },

              getHotels(newValue, oldValue){
                  this.loadHotel();
              }


          },

          beforeRouteLeave(to, from, next){
              this.clearHotelComponentData(true);
              this.clearLocationComponentData(true);
              next();
          }

      }
  </script>

  <style>

  </style>
