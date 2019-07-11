<template>
  <div>
    <h2 class="primary-text mb-3">
      Editing Hotel Service
      <span class="teal--text"> {{ hotelService.title }}</span>
    </h2>

    <v-tabs
            color="cyan"
            dark
            slider-color="red"
            v-model="tabs"
            show-arrows
    >
      <v-tab ripple target="room-type-details">Hotel Service Details</v-tab>
      <v-tab ripple target="room-type-media">Media</v-tab>

      <v-tab-item id="room-type-details">
        <v-alert
                :value="getUpdateHotelService.errorMessage"
                color="error"
                icon="warning"
                dismissible
                outline
                transition="scale-transition"
        >
          {{ getUpdateHotelService.errorMessage }}
        </v-alert>

        <v-form v-model="valid">
          <v-container>
            <v-layout row wrap>
              <v-flex xs12 sm6>
                <v-select
                        :items="getParentServices.data"
                        label="Select Parent Service"
                        item-text="title"
                        item-value="id"
                        v-model="hotelService.parent"
                        :error-messages = "serviceParentErrors"
                        @input="$v.hotelService.parent.$touch()"
                        @blur="$v.hotelService.parent.$touch()"
                ></v-select>
              </v-flex>

              <v-flex xs12 sm6>
                <v-text-field
                        v-model="hotelService.title"
                        label="Heading"
                        :error-messages = "serviceTitleErrors"
                        @input="$v.hotelService.title.$touch()"
                        @blur="$v.hotelService.title.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-textarea
                        v-model="hotelService.short_description"
                        label="Short Description"
                        :error-messages = "serviceDescriptionErrors"
                        @input="$v.hotelService.short_description.$touch()"
                        @blur="$v.hotelService.short_description.$touch()"
                >
                </v-textarea>
              </v-flex>

              <v-flex xs12>
                <vue-editor v-model="hotelService.long_description" placeholder="Long Description"/>
              </v-flex>

              <v-flex xs12 sm12>
                <v-btn :disabled="!valid" @click.prevent="submitUpdate">
                  submit
                </v-btn>
              </v-flex>
            </v-layout>
          </v-container>
        </v-form>

        <v-dialog
                v-model="getUpdateHotelService.loading"
                hide-overlay
                persistent
                width="300"
        >
          <v-card
                  color="blue"
                  dark
          >
            <v-card-text>
              Updating Hotel Service
              <v-progress-linear
                      indeterminate
                      color="white"
                      class="mb-0"
              ></v-progress-linear>
            </v-card-text>
          </v-card>
        </v-dialog>
      </v-tab-item>

      <v-tab-item id="room-type-media">
        <media-list
                :media="hotelService.media"
                :allow-upload="true"
                :max-allowed-upload="10"
                :allow-delete="true"
                :upload-link="uploadLink"
                v-on:media-uploaded="uploadedMedia($event)"
                v-on:media-deleted="fetchHotelServices"
        />
      </v-tab-item>

    </v-tabs>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import { VueEditor } from 'vue2-editor';
    import { required, maxLength, email, minLength, maxValue, numeric } from 'vuelidate/lib/validators';
    import MediaList from "../../media/MediaList";
    import { HOTEL_SERVICES_URLS } from '../../../constants';
    export default {

        name: 'RoomTypeUpdate',

        components: {
            'vue-editor': VueEditor,
            'media-list': MediaList,
        },
        data: () => ({
            valid: true,
            tabs: '',
            hotelService: {
                title: '',
                short_description: '',
                long_description: '',
                parent: undefined,
                media: []
            }

        }),

        validations: {
            hotelService: {
                title: {
                    required,
                    minLength: minLength(4)
                },
                short_description: {
                    required,
                    minLength: minLength(60)
                },
                parent: {
                    required,
                },
            }
        },

        methods: {
            ...mapActions('hotelService', ['fetchHotelServices', 'updateHotelService', 'clearHotelServiceComponentData']),
            submitUpdate(){
                this.$v.$touch();
                if(!this.$v.$invalid){
                    this.updateHotelService(this.hotelService);
                }
            },

            loadHotelService(){
                let hotelService = this.getHotelServices.data.find(r => r.id === this.$route.params.id);
                if(hotelService === undefined){
                    this.$router.push({ name: 'hotelServices' });
                } else {
                    this.hotelService = JSON.parse(JSON.stringify(hotelService));
                }
            },

            uploadedMedia(files){
                this.$toastr.s("Files uploaded successfully");
                this.fetchHotelServices();
            },
        },

        computed: {
            ...mapGetters('hotelService', ['getHotelServices', 'getUpdateHotelService', 'getParentServices']),

            uploadLink(){
                return `${HOTEL_SERVICES_URLS.GET}/${this.hotelService ? this.hotelService.id : ''}/addMedia`;
            },

            serviceTitleErrors () {
                const errors = [];
                if (!this.$v.hotelService.title.$dirty) return errors;
                !this.$v.hotelService.title.required && errors.push('You must enter a title');
                !this.$v.hotelService.title.minLength && errors.push(`Name must be at least ${this.$v.hotelService.title.$params.minLength.min} characters`);
                return errors
            },
            serviceDescriptionErrors () {
                const errors = [];
                if (!this.$v.hotelService.short_description.$dirty) return errors;
                !this.$v.hotelService.short_description.required && errors.push('You describe service in a few words :)');
                !this.$v.hotelService.short_description.minLength && errors.push(`Description must be at least ${this.$v.hotelService.short_description.$params.minLength.min} characters`);
                return errors
            },

            serviceParentErrors () {
                const errors = [];
                if (!this.$v.hotelService.parent.$dirty) return errors;
                !this.$v.hotelService.parent.required && errors.push('Select a parent service');
                return errors
            },
        },

        created() {},

        watch: {
            'getUpdateHotelService.done': function(value){
                if(value){
                    this.$toastr.s(`${this.hotelService.title} updated successfully`);
                    this.clearHotelServiceComponentData('setUpdateHotelService');
                }
            },

            'getHotelServices.data': function(){
                this.loadHotelService();
            }
        },

        mounted(){
            if (this.$route.params.id) {
                this.loadHotelService();
            }
        },

        beforeRouteLeave(to, from, next){
            next();
        }

    }
</script>

<style>

</style>