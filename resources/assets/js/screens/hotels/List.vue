<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Hotels</h1>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newHotel">New Hotel </v-btn>
    <v-data-table
            :headers="headers"
            :items="hotels"
            :loading="loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.image }}</td>
        <td>{{ props.item.name }}</td>
        <td>{{ props.item.email }}</td>
        <td>{{ props.item.phone }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="viewHotel(props.item)">visibility</v-icon>
          <v-icon small class="mr-2" @click.prevent="editHotel(props.item)">edit</v-icon>
          <v-icon small @click.prevent="deleteHotel(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>

</template>

<script>
  import { urlResolvers } from "../../services/helpers";
  import { mapActions, mapGetters } from 'vuex'
  export default {
        name: 'HotelsList',
        data: () => ({
            loading: false,
            totalHotels: 0,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Image', value: 'image' , sortable: false},
                { text: 'Title', value: 'name' , sortable: false},
                { text: 'Email', value: 'email' , sortable: false},
                { text: 'Phone', value: 'phone' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ]
        }),

        computed: {
            ...mapGetters({
                hotels: 'hotel/getHotels'
            }),
        },
        methods: {
            getHotels(){
                this.loading = true;
            },

            editHotel(hotel){
                if(property){
                    this.$router.push({ name: 'editHotel' , params: { id: hotel.id }});
                }
            },

            newHotel(){
                this.$router.push({ name: 'newHotel'});
            },

            deleteHotel(property){

            },

            viewHotel(property){

            }
        },

        created(){

        },

        mounted(){

        }
    }
</script>