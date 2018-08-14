<template>
  <div>
    <h2 class="primary-text mb-3">
      Creating Room Type
      <span class="teal--text"> {{ roomType.title }}</span>
    </h2>

    <v-alert
          :value="getCreateRoomType.errorMessage"
          color="error"
          icon="warning"
          dismissible
          outline
          transition="scale-transition"
    >
      {{ getCreateRoomType.errorMessage }}
    </v-alert>

    <v-form v-model="valid">
      <v-container>
        <v-layout row wrap>
          <v-flex xs12 sm4>
            <v-select
                    :items="getEligibleParentHotels"
                    label="Select Hotel"
                    item-text="name"
                    item-value="id"
                    v-model="roomType.hotel_id"
                    :error-messages="hotelIdErrors"
                    @input="$v.roomType.hotel_id.$touch()"
                    @blur="$v.roomType.hotel_id.$touch()"
            ></v-select>
          </v-flex>

          <v-flex xs12 sm4>
            <v-text-field
                    v-model="roomType.title"
                    label="Title"
                    required
                    :error-messages="titleErrors"
                    @input="$v.roomType.title.$touch()"
                    @blur="$v.roomType.title.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm4>
            <v-text-field
                    v-model="roomType.sub_title"
                    label="Sub Title"
                    required
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm12>
            <v-textarea
                    v-model="roomType.short_description"
                    label="Short Description"
                    required
                    :error-messages="shortDescErrors"
                    @input="$v.roomType.short_description.$touch()"
                    @blur="$v.roomType.short_description.$touch()"
            >

            </v-textarea>
          </v-flex>

          <v-flex xs12 sm12>
            <vue-editor v-model="roomType.description" placeholder="Enter Room description"/>
          </v-flex>

          <v-flex xs12 sm3>
            <v-text-field
                    v-model="roomType.max_children"
                    label="Max Children"
                    required
                    type="number"
                    :error-messages="maxChildrenErrors"
                    @input="$v.roomType.max_children.$touch()"
                    @blur="$v.roomType.max_children.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm3>
            <v-text-field
                    v-model="roomType.max_adults"
                    label="Max Adults"
                    required
                    type="number"
                    :error-messages="maxAdultsErrors"
                    @input="$v.roomType.max_adults.$touch()"
                    @blur="$v.roomType.max_adults.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm3>
            <v-text-field
                    v-model="roomType.max_people"
                    label="Max People"
                    required
                    type="number"
                    :error-messages="maxPeopleErrors"
                    @input="$v.roomType.max_people.$touch()"
                    @blur="$v.roomType.max_people.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm3>
            <v-text-field
                    v-model="roomType.base_price_per_night"
                    label="Base price per night"
                    required
                    type="number"
                    :error-messages="basePriceErrors"
                    @input="$v.roomType.base_price_per_night.$touch()"
                    @blur="$v.roomType.base_price_per_night.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm12>
            <v-btn :disabled="!valid" @click.prevent="submit">
              submit
            </v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>

    <v-dialog
            v-model="getCreateRoomType.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="blue"
              dark
      >
        <v-card-text>
          Creating room type
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
    import { VueEditor } from 'vue2-editor'
    import { required, maxLength, email, minLength, integer, maxValue, numeric } from 'vuelidate/lib/validators'
    export default {

        name: 'RoomTypeCreate',

        components: {
            'vue-editor': VueEditor
        },
        data: () => ({
            valid: true,
            roomType: {
                hotel_id: undefined,
                title: '',
                sub_title: '',
                short_description: '',
                display_image: '',
                description: '',
                max_children: undefined,
                max_adults: undefined,
                max_people: '',
                base_price_per_night: undefined,
                is_homepage: true,
            }

        }),

        validations: {
            roomType: {
                hotel_id: {
                    required,
                },
                title: {
                    required,
                    minLength: minLength(4)
                },
                description: {
                    required,
                    minLength: minLength(10)
                },
                short_description:{
                    required,
                    maxLength: maxLength(140)
                },
                max_children: {
                    required,
                    maxValue: maxValue(5)
                },
                max_adults: {
                    required,
                    maxValue: maxValue(5)
                },
                max_people: {
                    required,
                    maxValue: maxValue(10)
                },
                base_price_per_night: {
                    required,
                },
            }
        },

        methods: {
            ...mapActions('room', ['createRoomType', 'fetchRoomTypes', 'clearRoomComponentData']),
            submit(){
                this.$v.$touch();
                if(!this.$v.roomType.$invalid){
                  this.createRoomType(this.roomType);
                }
            }
        },

        computed: {
            ...mapGetters('room', ['getCreateRoomType']),
            ...mapGetters('hotel', ['getEligibleParentHotels']),
            hotelIdErrors () {
                const errors = [];
                if (!this.$v.roomType.hotel_id.$dirty) return errors;
                !this.$v.roomType.hotel_id.required && errors.push('Please select a hotel');
                return errors
            },

            titleErrors () {
                const errors = [];
                if (!this.$v.roomType.title.$dirty) return errors;
                !this.$v.roomType.title.required && errors.push('You must enter a name');
                !this.$v.roomType.title.minLength && errors.push(`Name must be at least ${this.$v.roomType.title.$params.minLength.min} characters`);
                return errors
            },
            descriptionErrors () {
                const errors = [];
                if (!this.$v.roomType.description.$dirty) return errors;
                !this.$v.roomType.description.required && errors.push('You describe room in a few words :)');
                !this.$v.roomType.description.minLength && errors.push(`Name must be at least ${this.$v.roomType.description.$params.minLength.min} characters`);
                return errors
            },

            maxChildrenErrors() {
                const errors = [];
                if (!this.$v.roomType.max_children.$dirty) return errors;
                !this.$v.roomType.max_children.required && errors.push('Max children is required');
                !this.$v.roomType.max_children.maxValue && errors.push(`This cannot be more than ${this.$v.roomType.max_children.$params.maxValue.max}`);
                return errors
            },

            maxAdultsErrors() {
                const errors = [];
                if (!this.$v.roomType.max_adults.$dirty) return errors;
                !this.$v.roomType.max_adults.required && errors.push('Max Adults is required');
                !this.$v.roomType.max_adults.maxValue && errors.push(`This cannot be more than ${this.$v.roomType.max_adults.$params.maxValue.max}`);
                return errors
            },

            maxPeopleErrors() {
                const errors = [];
                if (!this.$v.roomType.max_people.$dirty) return errors;
                !this.$v.roomType.max_people.required && errors.push('Max People is required');
                !this.$v.roomType.max_people.maxValue && errors.push(`This cannot be more than ${this.$v.roomType.max_people.$params.maxValue.max}`);
                return errors
            },

            basePriceErrors() {
                const errors = [];
                if (!this.$v.roomType.base_price_per_night.$dirty) return errors;
                !this.$v.roomType.base_price_per_night.required && errors.push('This is super required!!!');
                return errors
            },
            shortDescErrors(){
                const errors = [];
                if (!this.$v.roomType.short_description.$dirty) return errors;
                !this.$v.roomType.short_description.required && errors.push('A short description of the room is required');
                !this.$v.roomType.short_description.maxLength && errors.push(`Should not be longer than ${this.$v.roomType.short_description.$params.minLength.min} characters`);
                return errors
            }
        },

        created() {},

        watch: {
            'getCreateRoomType.done': function(value){
                if(value){
                    this.$toastr.s(`${this.roomType.title} room created successfully`);
                    this.clearRoomComponentData('setCreateRoomType');
                    this.$router.push({ name: 'roomTypes'});
                }
            }
        },

        beforeRouteLeave(to, from, next){
            next();
        }

    }
</script>

<style>

</style>