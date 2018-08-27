<template>
  <div>
    <h2 class="primary-text mb-3">
      Rooms
    </h2>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newRooms">New Rooms</v-btn>
    <v-data-table
            :headers="headers"
            :items="getRooms.data"
            :loading="getRooms.loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.room_code }}</td>
        <td>{{ getRoomTitle(props.item.room_type_id) }}</td>
        <td>{{ getHotelName(props.item.hotel_id) }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small @click.prevent="deleteRoom(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>

    <v-dialog v-model="createDialog" max-width="700px" :scrollable="true">
      <v-card>
        <v-card-title>
          <span class="headline">Create Room{{ rooms.count > 1 ? 's' : '' }}
            {{ rooms.count > 1 ? rooms.prefix.toString()+rooms.start+' - '+rooms.prefix.toString()+(parseInt(rooms.start) + parseInt(rooms.count) - 1) : rooms.prefix.toString()+rooms.start }}
          </span>
        </v-card-title>

        <v-card-text>
          <v-container grid-list-md>
            <v-alert
                    :value="getCreateRooms.errorMessage"
                    color="error"
                    icon="warning"
                    dismissible
                    outline
                    transition="scale-transition"
            >
              {{ getCreateRooms.errorMessage }}
            </v-alert>
            <v-layout wrap>
              <v-flex xs12 sm6>
                <v-select
                        :items="getHotels"
                        label="Select Hotel"
                        item-text="name"
                        item-value="id"
                        v-model="rooms.hotelId"
                        :error-messages = "roomHotelErrors"
                        @input="$v.rooms.hotelId.$touch()"
                        @blur="$v.rooms.hotelId.$touch()"
                ></v-select>
              </v-flex>

              <v-flex xs12 sm6>
                <v-select
                        :items="availableRoomTypes"
                        label="Select Room Type"
                        item-text="title"
                        item-value="id"
                        v-model="rooms.roomTypeId"
                        :error-messages = "roomTypeErrors"
                        @input="$v.rooms.hotelId.$touch()"
                        @blur="$v.rooms.hotelId.$touch()"
                ></v-select>
              </v-flex>

              <v-flex xs12 sm4>
                <v-text-field
                        v-model="rooms.count"
                        label="How many rooms"
                        type="number"
                        min="0"
                        :error-messages = "roomCountErrors"
                        @input="$v.rooms.count.$touch()"
                        @blur="$v.rooms.count.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm4>
                <v-text-field
                        v-model="rooms.start"
                        label="Start counting from"
                        type="number"
                        :error-messages = "roomStartErrors"
                        @input="$v.rooms.start.$touch()"
                        @blur="$v.rooms.start.$touch()"
                >
                </v-text-field>
              </v-flex>

              <v-flex xs12 sm4>
                <v-text-field
                        v-model="rooms.prefix"
                        label="Prefix(E.g RM to result in RM45, optional)"
                >
                </v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-container>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" @click.prevent="closeDialog">Cancel</v-btn>
            <v-btn color="green darken-1" @click.prevent="submitCreate" :disabled="rooms.count < 1">Create</v-btn>
          </v-container>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
            v-model="getCreateRooms.loading"
            hide-overlay
            persistent
            width="300"
    >
      <v-card
              color="green"
              dark
      >
        <v-card-text>
          Creating {{ rooms.count }} rooms
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
    import { required, maxLength, email, minLength, minValue } from 'vuelidate/lib/validators'

    export default {

        name: 'RoomsList',
        data: () => ({
            createDialog: false,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Room No', value: 'room_code' , sortable: false},
                { text: 'Room Type', value: 'room_type_id' , sortable: false},
                { text: 'Hotel', value: 'hotel_id' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ],
            availableRoomTypes: [],
            rooms: {
                hotelId: undefined,
                roomTypeId: undefined,
                count: 1,
                start: 1,
                prefix: 'RM'
            },
            defaultRooms: {
                hotelId: undefined,
                roomTypeId: undefined,
                count: 1,
                start: 1,
                prefix: 'RM'
            }
        }),

        validations: {
            rooms: {
                hotelId: {
                    required
                },
                roomTypeId: {
                    required
                },
                count: {
                    required,
                    minValue: minValue(1)
                },
                start: {
                    required,
                    minValue: minValue(1)
                },
            }
        },

        methods: {
            ...mapActions('room', ['fetchRooms', 'createRooms', 'clearRoomComponentData']),

            newRooms(){
              this.createDialog = true;
            },

            closeDialog(){
                this.createDialog = false;
                this.rooms = Object.assign({}, this.defaultRooms);
            },

            deleteRoom(room){

            },

            submitCreate(){
                this.$v.$touch();
                if(!this.$v.rooms.$invalid){
                    this.createRooms(this.rooms);
                }
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
            ...mapGetters('room', ['getRooms', 'getRoomTypes', 'getCreateRooms']),
            ...mapGetters('hotel', ['getHotels', 'getHotelById']),

            roomHotelErrors () {
                const errors = [];
                if (!this.$v.rooms.hotelId.$dirty) return errors;
                !this.$v.rooms.hotelId.required && errors.push('Select a hotel');
                return errors
            },

            roomTypeErrors () {
                const errors = [];
                if (!this.$v.rooms.roomTypeId.$dirty) return errors;
                !this.$v.rooms.roomTypeId.required && errors.push('Select a room type');
                return errors
            },

            roomCountErrors () {
                const errors = [];
                if (!this.$v.rooms.count.$dirty) return errors;
                !this.$v.rooms.count.required && errors.push('How many rooms are being created');
                !this.$v.rooms.count.minValue && errors.push(`Must be at least ${this.$v.rooms.count.$params.minValue.min}`);
                return errors
            },

            roomStartErrors () {
                const errors = [];
                if (!this.$v.rooms.start.$dirty) return errors;
                !this.$v.rooms.start.required && errors.push('Where should the count start from');
                !this.$v.rooms.start.minValue && errors.push(`Must be at least ${this.$v.rooms.start.$params.minValue.min}`);
                return errors
            },
        },

        created() {},

        watch: {
            'rooms.hotelId': function(newValue) {
                let hotel = this.getHotelById(newValue);
                if(hotel){
                    if(hotel.parent_hotel_id === null){
                        this.availableRoomTypes = hotel.room_types;
                    } else {
                        let parentHotel = this.getHotelById(hotel.parent_hotel_id);
                        this.availableRoomTypes = parentHotel.room_types;
                    }
                }
            },

            'getCreateRooms.done': function(done) {
                if(done){
                    this.$toastr.s("Rooms created successfully");
                    this.clearRoomComponentData('setCreateRooms');
                    this.closeDialog();
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