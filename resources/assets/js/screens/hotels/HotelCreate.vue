<template>
  <div>
    <h2 class="primary-text mb-3">
      Creating Hotel
      <span class="teal--text"> {{ hotel.name }}</span>
    </h2>

    <v-alert
            :value="errors"
            color="error"
            icon="warning"
            dismissible
            outline
            transition="scale-transition"
    >
      {{ errors }}
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
            <v-textarea
                v-model="hotel.description"
                label="Description"
                required
                :error-messages = "hotelDescriptionErrors"
                @input="$v.hotel.description.$touch()"
                @blur="$v.hotel.description.$touch()"
            />
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
                  :items="getEligibleParentHotels"
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

    <v-dialog
      v-model="isCreatingHotel"
      hide-overlay
      persistent
      width="300"
    >
      <v-card
        color="blue"
        dark
      >
        <v-card-text>
          Updating hotel...
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
    import {mapActions, mapGetters} from 'vuex'
    import { required, maxLength, email, minLength } from 'vuelidate/lib/validators'

    export default {
        name: 'HotelCreate',
        data: () => ({
            valid: true,
            errors: '',
            hotel: {
                name: '',
                sub_title: '',
                description: '',
                email: '',
                phone: '',
                website: '',
                parent_hotel_id: '',
                is_active: true,
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
            }
        },

        methods: {
            ...mapActions('hotel', ['createHotel', 'clearHotelComponentData']),
            submit(){
                this.$v.$touch();
                console.log(this.$v);
                if(!this.$v.$error){
                    this.createHotel(this.hotel);
                }
            }
        },

        computed: {
            ...mapGetters('hotel',
              ['getHotelById', 'getHotels', 'getEligibleParentHotels', 'isCreatingHotel', 'creatingHotelError', 'createdHotel']
            ),
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
                !this.$v.hotel.email.required && errors.push('You enter hotel contact email address');
                !this.$v.hotel.email.email && errors.push(`Please enter a valid email address`);
                return errors
            },

            hotelPhoneErrors () {
                const errors = [];
                if (!this.$v.hotel.phone.$dirty) return errors;
                !this.$v.hotel.phone.required && errors.push('You enter hotel contact phone number');
                return errors
            }
        },

        created() {

        },

        watch: {
            creatingHotelError(value){
                if(typeof value === 'string'){
                    this.errors = value;
                } else {
                    if(Object.keys(value).length > 0){
                        this.errors = "You form submission has errors";
                    }
                }
            },

            createdHotel(value){
                if(value){
                    this.$toastr.s("Hotel Created Successfully");
                    this.$router.push({ name: 'hotels' })
                }
            }

        },

        beforeRouteLeave(to, from, next){
            this.clearHotelComponentData(true);
            next();
        }

    }
</script>

<style>

</style>