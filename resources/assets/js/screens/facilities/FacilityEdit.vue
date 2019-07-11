<template>
  <div>
    <h2 class="primary-text mb-3">
      Editing Facility
      <span class="teal--text"> {{ facility.name }}</span>
    </h2>

    <v-tabs
            color="cyan"
            dark
            slider-color="red"
            v-model="tabs"
            show-arrows
    >
      <v-tab ripple target="room-type-details">Facility Details</v-tab>
      <v-tab ripple target="room-type-media">Media</v-tab>

      <v-tab-item id="room-type-details">
        <v-alert
                :value="getUpdateFacility.errorMessage"
                color="error"
                icon="warning"
                dismissible
                outline
                transition="scale-transition"
        >
          {{ getUpdateFacility.errorMessage }}
        </v-alert>

        <v-form v-model="valid">
          <v-container>
            <v-layout row wrap>
              <v-flex xs12>
                <v-text-field
                        v-model="facility.name"
                        label="Name"
                        :error-messages = "facilityNameErrors"
                        @input="$v.facility.name.$touch()"
                        @blur="$v.facility.name.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-textarea
                        v-model="facility.short_description"
                        label="Short Description"
                        :error-messages = "facilityDescriptionErrors"
                        @input="$v.facility.short_description.$touch()"
                        @blur="$v.facility.short_description.$touch()"
                >
                </v-textarea>
              </v-flex>

              <v-flex xs12>
                <vue-editor v-model="facility.description" placeholder="Long Description"/>
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
                v-model="getUpdateFacility.loading"
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
                :media="facility.media"
                :allow-upload="true"
                :max-allowed-upload="10"
                :allow-delete="true"
                :upload-link="uploadLink"
                v-on:media-uploaded="uploadedMedia($event)"
                v-on:media-deleted="fetchFacilities"
        />
      </v-tab-item>

    </v-tabs>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import { VueEditor } from 'vue2-editor';
    import { required, maxLength, email, minLength, maxValue, numeric } from 'vuelidate/lib/validators';
    import MediaList from "../media/MediaList";
    import { FACILITY_URLS } from '../../constants';
    export default {

        name: 'FacilityUpdate',

        components: {
            'vue-editor': VueEditor,
            'media-list': MediaList,
        },
        data: () => ({
            valid: true,
            tabs: '',
            facility: {
                id: undefined,
                name: '',
                short_description: '',
                description: '',
                media: []
            }

        }),

        validations: {
            facility: {
                name: {
                    required,
                    minLength: minLength(3)
                },
                short_description: {
                    required,
                    minLength: minLength(60)
                },
            }
        },

        methods: {
            ...mapActions('facility', ['fetchFacilities', 'updateFacility', 'clearFacilityComponentData']),
            submitUpdate(){
                this.$v.$touch();
                if(!this.$v.$invalid){
                    this.updateFacility(this.facility);
                }
            },

            loadFacility(){
                let facility = this.getFacilities.data.find(r => r.id === this.$route.params.id);
                if(facility === undefined){
                    this.$router.push({ name: 'facilities' });
                } else {
                    this.facility = JSON.parse(JSON.stringify(facility));
                }
            },

            uploadedMedia(files){
                this.$toastr.s("Files uploaded successfully");
                this.fetchFacilities();
            },
        },

        computed: {
            ...mapGetters('facility', ['getFacilities', 'getUpdateFacility']),

            uploadLink(){
                return `${FACILITY_URLS.GET}/${this.facility ? this.facility.id : ''}/addMedia`;
            },

            facilityNameErrors () {
                const errors = [];
                if (!this.$v.facility.name.$dirty) return errors;
                !this.$v.facility.name.required && errors.push('You must enter a name');
                !this.$v.facility.name.minLength && errors.push(`Name must be at least ${this.$v.facility.name.$params.minLength.min} characters`);
                return errors
            },
            facilityDescriptionErrors () {
                const errors = [];
                if (!this.$v.facility.short_description.$dirty) return errors;
                !this.$v.facility.short_description.required && errors.push('You describe facility in a few words :)');
                !this.$v.facility.short_description.minLength && errors.push(`Description must be at least ${this.$v.facility.short_description.$params.minLength.min} characters`);
                return errors
            },
        },

        created() {},

        watch: {
            'getUpdateFacility.done': function(value){
                if(value){
                    this.$toastr.s(`Fcility updated successfully`);
                    this.clearFacilityComponentData('setUpdateFacility');
                }
            },

            'getFacilities.data': function(){
                this.loadFacility();
            }
        },

        mounted(){
            if (this.$route.params.id) {
                this.loadFacility();
            }
        },

        beforeRouteLeave(to, from, next){
            next();
        }

    }
</script>

<style>

</style>