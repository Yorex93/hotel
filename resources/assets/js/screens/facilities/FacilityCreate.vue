<template>
  <div>
    <h2 class="primary-text mb-3">
      Creating Facility
      <span class="teal--text"> {{ facility.name }}</span>
    </h2>

    <v-alert
            :value="getCreateFacility.errorMessage"
            color="error"
            icon="warning"
            dismissible
            outline
            transition="scale-transition"
    >
      {{ getCreateFacility.errorMessage }}
    </v-alert>

    <v-form v-model="valid">
      <v-container>
        <v-layout row wrap>
          <v-flex xs12 sm4>
            <v-text-field
                    v-model="facility.name"
                    label="Name"
                    required
                    :error-messages="nameErrors"
                    @input="$v.facility.name.$touch()"
                    @blur="$v.facility.name.$touch()"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm4>
            <h4>Icon</h4>
            <input @change="fileChanged($event.target.files)" type="file">
          </v-flex>

          <v-flex xs12 sm12>
            <v-textarea
                  v-model="facility.short_description"
                  label="Short Description"
            >
            </v-textarea>
          </v-flex>

          <v-flex xs12 sm12>
            <vue-editor v-model="facility.description" placeholder="A longer description can go here"/>
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
            v-model="getCreateFacility.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="blue"
              dark
      >
        <v-card-text>
          Creating facility
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

        name: 'FacilityCreate',

        components: {
            'vue-editor': VueEditor
        },
        data: () => ({
            valid: true,
            facility: {
                id: undefined,
                name: '',
                short_description: '',
                description: '',
                image: '',
                icon: '',
                iconFile: undefined
            }
        }),

        validations: {
            facility: {
                name: {
                    required,
                },
            }
        },

        methods: {
            ...mapActions('facility', ['createFacility', 'fetchFacilities', 'clearFacilityComponentData']),
            submit(){
                this.$v.$touch();
                let data = new FormData();
                if(!this.$v.facility.$invalid){
                    this.createFacility(this.facility);
                }
            },
            fileChanged(files){
                this.facility.iconFile = files ? files[0] : undefined;
            }
        },

        computed: {
            ...mapGetters('facility', ['getFacilities', 'getCreateFacility']),
            nameErrors () {
                const errors = [];
                if (!this.$v.facility.name.$dirty) return errors;
                !this.$v.facility.name.required && errors.push('Please enter a name');
                return errors
            },

        },

        created() {},

        watch: {
            'getCreateFacility.done': function(value){
                if(value){
                    this.$toastr.s(`${this.facility.name} created successfully`);
                    this.clearFacilityComponentData('setCreateFacility');
                    this.$router.push({ name: 'facilities'});
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