<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Hotel Serivices</h1>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newHotelService">New Hotel Service </v-btn>
    <v-data-table
            :headers="headers"
            :items="getHotelServices.data"
            :loading="getHotelServices.loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.title }}</td>
        <td>{{ props.item.parent_service.title }}</td>
        <td>{{ props.item.parent_service.category }}</td>
        <td>{{ props.item.short_description }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="editHotelService(props.item)">edit</v-icon>
          <v-icon small @click.prevent="submitDelete(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>

    <v-dialog v-model="dialog" max-width="800px" :scrollable="true">
      <v-card>
        <v-card-title>
          <span class="headline">Creating {{ createdItem.title }}</span>
        </v-card-title>

        <v-card-text style = "height: 480px">
          <v-container grid-list-md>
            <v-alert
                    :value="getCreateHotelService.errorMessage"
                    color="error"
                    icon="warning"
                    dismissible
                    outline
                    transition="scale-transition"
            >
              {{ getCreateHotelService.errorMessage }}
            </v-alert>
            <v-layout wrap>
              <v-flex xs12>
                <v-select
                        :items="getParentServices.data"
                        label="Select Parent Service"
                        item-text="title"
                        item-value="id"
                        v-model="createdItem.parent"
                        :error-messages = "serviceParentErrors"
                        @input="$v.createdItem.parent.$touch()"
                        @blur="$v.createdItem.parent.$touch()"
                ></v-select>
              </v-flex>

              <v-flex xs12>
                <v-text-field
                        v-model="createdItem.title"
                        label="Heading"
                        :error-messages = "serviceTitleErrors"
                        @input="$v.createdItem.title.$touch()"
                        @blur="$v.createdItem.title.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12>
                <v-textarea
                        v-model="createdItem.short_description"
                        label="Short Description"
                        :error-messages = "serviceDescriptionErrors"
                        @input="$v.createdItem.short_description.$touch()"
                        @blur="$v.createdItem.short_description.$touch()"
                >
                </v-textarea>
              </v-flex>

              <v-flex xs12>
                <vue-editor v-model="createdItem.long_description" placeholder="Long Description"/>
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
            v-model="getCreateHotelService.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="green"
              dark
      >
        <v-card-text>
          Creating Hotel Service
          <v-progress-linear
                  indeterminate
                  color="white"
                  class="mb-0"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="getDeleteHotelService.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="red"
              dark
      >
        <v-card-text>
          Deleting Hotel Service
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
        name: 'PageList',
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
                { text: 'Title', value: 'name' , sortable: true},
                { text: 'Parent', value: 'icon' , sortable: false},
                { text: 'Category', value: 'icon' , sortable: false},
                { text: 'Short Description', value: 'image' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ],
            createdItem: {
                title: '',
                short_description: '',
                long_description: '',
                parent: undefined
            },
            defaultItem: {
                title: '',
                short_description: '',
                long_description: '',
                parent: undefined
            },

            selected: {
                title: '',
                short_description: '',
                long_description: '',
                parent: undefined
            }
        }),

        validations: {
            createdItem: {
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
            ...mapActions('hotelService', ['fetchHotelServices', 'createHotelService', 'deleteHotelService', 'clearHotelServiceComponentData']),
            editHotelService(hotelService){
                this.$router.push({name: 'editHotelService', params: { id: hotelService.id } })
            },

            submitCreate(){
                this.$v.$touch();
                if(!this.$v.$invalid){
                    this.createHotelService(this.createdItem);
                }
            },

            submitDelete(hotelService){
                this.selected = Object.assign({}, hotelService);
                this.deleteDialog = true;
            },

            newHotelService(){
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
                this.deleteHotelService(this.selected);
            }
        },

        computed: {
            ...mapGetters('hotelService', ['getHotelServices', 'getCreateHotelService', 'getDeleteHotelService', 'getParentServices']),
            serviceTitleErrors () {
                const errors = [];
                if (!this.$v.createdItem.title.$dirty) return errors;
                !this.$v.createdItem.title.required && errors.push('You must enter a title');
                !this.$v.createdItem.title.minLength && errors.push(`Name must be at least ${this.$v.createdItem.title.$params.minLength.min} characters`);
                return errors
            },
            serviceDescriptionErrors () {
                const errors = [];
                if (!this.$v.createdItem.short_description.$dirty) return errors;
                !this.$v.createdItem.short_description.required && errors.push('You describe service in a few words :)');
                !this.$v.createdItem.short_description.minLength && errors.push(`Description must be at least ${this.$v.createdItem.short_description.$params.minLength.min} characters`);
                return errors
            },

            serviceParentErrors () {
                const errors = [];
                if (!this.$v.createdItem.parent.$dirty) return errors;
                !this.$v.createdItem.parent.required && errors.push('Select a parent service');
                return errors
            },

        },

        created() {},

        watch: {
            'getCreateHotelService.done': function(value){
                if(value){
                    this.$toastr.s(`Service Created successfully`);
                    this.dialog = false;
                    this.close();
                    this.clearHotelServiceComponentData('setCreateHotelService');
                }
            },

            'getDeleteHotelService.done': function(value){
                if(value){
                    this.$toastr.s(`Service Deleted successfully`);
                    this.closeDeleteDialog();
                    this.clearHotelServiceComponentData('setDeleteHotelService');
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