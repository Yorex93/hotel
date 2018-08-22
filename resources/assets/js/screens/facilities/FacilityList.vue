<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Facilities</h1>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newFacility">New Facility</v-btn>
    <v-data-table
            :headers="headers"
            :items="getFacilities.data"
            :loading="getFacilities.loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.name }}</td>
        <td>{{ props.item.short_description }}</td>
        <td>{{ props.item.media.length }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="editFacility(props.item)">edit</v-icon>
          <v-icon small @click.prevent="submitDelete(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>

    <v-dialog v-model="dialog" max-width="800px" :scrollable="true">
      <v-card>
        <v-card-title>
          <span class="headline">Creating {{ createdItem.name }}</span>
        </v-card-title>

        <v-card-text style = "height: 480px">
          <v-container grid-list-md>
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
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field
                        v-model="createdItem.name"
                        label="Name"
                        :error-messages = "facilityNameErrors"
                        @input="$v.createdItem.name.$touch()"
                        @blur="$v.createdItem.name.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-textarea
                        v-model="createdItem.short_description"
                        label="Short Description"
                        :error-messages = "facilityDescriptionErrors"
                        @input="$v.createdItem.short_description.$touch()"
                        @blur="$v.createdItem.short_description.$touch()"
                >
                </v-textarea>
              </v-flex>

              <v-flex xs12>
                <vue-editor v-model="createdItem.description" placeholder="Long Description"/>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-container>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" @click.prevent="close">Cancel</v-btn>
            <v-btn color="green darken-1" @click.prevent="submitCreate">Save</v-btn>
          </v-container>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="getCreateFacility.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="green"
              dark
      >
        <v-card-text>
          Creating Facility
          <v-progress-linear
                  indeterminate
                  color="white"
                  class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="getDeleteFacility.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="red"
              dark
      >
        <v-card-text>
          Deleting Facility
          <v-progress-linear
                  indeterminate
                  color="white"
                  class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="deleteDialog"
            max-width="290"
    >
      <v-card>
        <v-card-title class="headline">Are you sure?</v-card-title>

        <v-card-text>
          This action is irreversible
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
                  color="blue darken-1"
                  flat="flat"
                  @click="closeDeleteDialog"
          >
            Cancel
          </v-btn>

          <v-btn
                  color="red darken-1"
                  flat="flat"
                  @click="deleteSelected"
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import { VueEditor } from 'vue2-editor';
    import { required, maxLength, email, minLength } from 'vuelidate/lib/validators'
    export default {
        components: {
            'vue-editor': VueEditor
        },
        name: 'FacilityList',
        data: () => ({

            totalFacilities: 0,
            dialog: false,
            deleteDialog: false,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Name', value: 'name' , sortable: true},
                { text: 'Short description', value: 'description' , sortable: false},
                { text: 'Media', value: 'media' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ],
            createdItem: {
                name: '',
                short_description: '',
                description: '',
            },
            defaultItem: {
                name: '',
                short_description: '',
                description: '',
            },

            selected: {
                name: '',
                short_description: '',
                description: '',
            }
        }),

        validations: {
            createdItem: {
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
            ...mapActions('facility', ['fetchFacilities', 'createFacility', 'deleteFacility', 'clearFacilityComponentData']),
            editFacility(facility){
                this.$router.push({name: 'editFacility', params: { id: facility.id } })
            },

            submitCreate(){
                this.$v.$touch();
                if(!this.$v.$invalid){
                    this.createFacility(this.createdItem);
                }
            },

            submitDelete(facility){
                this.selected = Object.assign({}, facility);
                this.deleteDialog = true;
            },

            newFacility(){
                this.dialog = true;
            },

            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.createdItem = Object.assign({}, this.defaultItem)
                }, 300)
            },

            closeDeleteDialog(){
                this.deleteDialog = false;
                this.selected = Object.assign({}, this.defaultItem)
            },

            deleteSelected(){
                this.deleteFacility(this.selected);
            }
        },

        computed: {
            ...mapGetters('facility', ['getFacilities', 'getCreateFacility', 'getDeleteFacility']),
            facilityNameErrors () {
                const errors = [];
                if (!this.$v.createdItem.name.$dirty) return errors;
                !this.$v.createdItem.name.required && errors.push('You must enter a name');
                !this.$v.createdItem.name.minLength && errors.push(`Name must be at least ${this.$v.createdItem.name.$params.minLength.min} characters`);
                return errors
            },
            facilityDescriptionErrors () {
                const errors = [];
                if (!this.$v.createdItem.short_description.$dirty) return errors;
                !this.$v.createdItem.short_description.required && errors.push('You describe facility in a few words :)');
                !this.$v.createdItem.short_description.minLength && errors.push(`Description must be at least ${this.$v.createdItem.short_description.$params.minLength.min} characters`);
                return errors
            },
        },

        created() {},

        watch: {
            'getCreateFacility.done': function(value){
                if(value){
                    this.$toastr.s(`Facility Created successfully`);
                    this.dialog = false;
                    this.close();
                    this.clearFacilityComponentData('setCreateFacility');
                }
            },

            'getDeleteFacility.done': function(value){
                if(value){
                    this.$toastr.s(`Facility Deleted successfully`);
                    this.closeDeleteDialog();
                    this.clearFacilityComponentData('setDeleteFacility');
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