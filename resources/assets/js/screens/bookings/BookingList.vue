<template>
  <div>
    <h2 class="primary-text mb-3">
      Bookings
    </h2>

    <v-data-table
            :headers="headers"
            :items="bookings"
            :pagination.sync="pagination"
            :total-items="totalBookings"
            :loading="loading"
            :disable-page-reset="true"
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.booking_ref }}</td>
        <td>{{ props.item.first_name }} {{ props.item.last_name }}</td>
        <td>{{ props.item.email }}<br><b>{{ props.item.phone }}</b></td>
        <td>{{ getHotelName(props.item.hotel_id) }}<br><b>{{ getRoomTitle(props.item.booking_rooms[0].room_type_id) }}</b></td>
        <td>{{ props.item.total_due | formatCurrency }}</td>
        <td>{{ props.item.created_at | dateFilter }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click="viewBooking(props.item)">visibility</v-icon>
        </td>
      </template>
    </v-data-table>


  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import * as bookingService from '../../services/booking-service';
    export default {

        name: 'BookingList',
        data: () => ({
            loading: false,
            bookings: [],
            totalBookings: 0,
            headers: [
                {
                    text: 'id',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                { text: 'Booking Ref', value: 'booking_ref' , sortable: false},
                { text: 'Customer Name', value: 'name' , sortable: false},
                { text: 'Contact', value: 'email' , sortable: false},
                { text: 'Hotel Room', value: 'phone' , sortable: false},
                { text: 'Total Amount', value: 'total_due' , sortable: false},
                { text: 'Booking Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ],
            pagination: { page: 0, rowsPerPage: 15 },
            requestObject: {
                keyword: '',
                startDate: '',
                endDate: '',
                status: '',
                checkIn: '',
                hotel_id: '',
                room_type_id: '',
                booking_ref: ''
            },
            watchBoolean: true,
        }),

        validations: {},

        methods: {
            // ...mapActions(''),
            getBookings(){
                if(this.watchBoolean){
                    this.watchBoolean = false;
                }
                let requestObject = { ...this.requestObject, page: this.pagination.page, per_page: this.pagination.rowsPerPage };
                bookingService.getBookings(requestObject).then((resp) => {
                    let response = resp.data;
                    this.bookings = response.data;
                    this.totalBookings = response.total;
                    this.loading = false;
                }).catch((error) => {

                }).finally(() => {
                    this.loading = false;
                })
            },

            viewBooking(booking){

            },

            getRoomTitle(roomId){
                let roomType = this.getRoomTypes.data.find(r => r.id === roomId);
                return roomType ? roomType.title : '';
            },

            getHotelName(hotelId){
                let hotel = this.getHotels.find(h => h.id === hotelId);
                return hotel ? hotel.name : '';
            }
        },

        computed: {
            ...mapGetters('room', ['getRoomTypes']),
            ...mapGetters('hotel', ['getHotels']),
        },

        watch: {
            pagination: {
                handler () {
                    if(!this.watchBoolean){
                        this.getBookings();
                    }

                },
                deep: true
            }
        },

        created(){

        },

        mounted(){
            this.getBookings();
        },


    }
</script>

<style>

</style>