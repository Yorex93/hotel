<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Page Items</h1>
    <v-data-table
            :headers="headers"
            :items="getPageItems.data"
            :loading="getPageItems.loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.page.title }}</td>
        <td>{{ props.item.for }}</td>
        <td>{{ props.item.heading }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="editPageItem(props.item)">edit</v-icon>
        </td>
      </template>
    </v-data-table>

    <v-dialog v-model="dialog" max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline">Editing {{ editedItem.for }}</span>
        </v-card-title>

        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field v-model="editedItem.heading" label="Heading"></v-text-field>
              </v-flex>
              <v-flex xs12>
                <vue-editor v-model="editedItem.content" placeholder="Enter Content"></vue-editor>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.prevent="close">Cancel</v-btn>
          <v-btn color="blue darken-1" flat @click.prevent="submitUpdate">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="getUpdatePageItem.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="green"
              dark
      >
        <v-card-text>
          Updating pageItem
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
    import { VueEditor } from 'vue2-editor';
    export default {
        components: {
            'vue-editor': VueEditor
        },
        name: 'PageList',
        data: () => ({

            totalFacilities: 0,
            dialog: false,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Page', value: 'name' , sortable: true},
                { text: 'For', value: 'icon' , sortable: false},
                { text: 'Heading', value: 'image' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ],
            editedItem: {
                id: '',
                heading: '',
                content: '',
                for: '',
            },

            defaultItem: {
                id: '',
                heading: '',
                content: '',
                for: ''
            }
        }),

        validations: {},

        methods: {
             ...mapActions('page', ['fetchPageItems', 'updatePageItem', 'clearPageComponentData']),
            editPageItem(pageItem){
              this.editedItem = Object.assign({}, pageItem);
              this.dialog = true;
            },

            submitUpdate(){
                 this.updatePageItem(this.editedItem);
            },

            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                }, 300)
            },
        },

        computed: {
             ...mapGetters('page', ['getPageItems', 'getUpdatePageItem']),
        },

        created() {},

        watch: {
            'getUpdatePageItem.done': function(value){
                if(value){
                    this.$toastr.s(`Updated successfully`);
                    this.dialog = false;
                    this.clearPageComponentData();
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