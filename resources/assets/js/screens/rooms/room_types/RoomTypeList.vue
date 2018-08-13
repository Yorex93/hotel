<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Room Types</h1>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newRoomType">New Room Type </v-btn>
    <v-data-table
            :headers="headers"
            :items="getRoomTypes.data"
            :loading="getRoomTypes.loading"
            :disable-page-reset="true"
            hide-actions
            class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.title }}</td>
        <td>{{ props.item.hotel.name }}</td>
        <td>{{ props.item.max_children }}</td>
        <td>{{ props.item.max_adults }}</td>
        <td>{{ props.item.max_people }}</td>
        <td>{{ props.item.base_price_per_night }}</td>
        <td>{{ props.item.rooms.length }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="viewRoomType(props.item)">visibility</v-icon>
          <v-icon small class="mr-2" @click.prevent="editRoomType(props.item)">edit</v-icon>
          <v-icon small @click.prevent="deleteRoomType(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>

</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import { fileResolvers, urlResolvers } from '../../../services/helpers';
    export default {
        name: 'RoomTypeList',
        data: () => ({
            loading: false,
            totalRoomTypes: 0,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Title', value: 'title' , sortable: false},
                { text: 'Hotel', value: 'title.hotel' , sortable: false},
                { text: 'Max Children', value: 'max_children' , sortable: false},
                { text: 'Max Adults', value: 'max_adults' , sortable: false},
                { text: 'Max People' , value: 'max_people', sortable: false},
                { text: 'Price per night', value: 'base_price_per_night', sortable: false},
                { text: 'Rooms', value: 'rooms', sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ]
        }),

        computed: {
            ...mapGetters('room', ['getRoomTypes']),
        },
        methods: {
            ...mapActions('room', ['fetchRoomTypes']),
            editRoomType(roomType){
                if(roomType){
                    this.$router.push({ name: 'editRoomType' , params: { id: roomType.id }});
                }
            },

            newRoomType(){
                this.$router.push({ name: 'createRoomType'});
            },

            deleteRoomType(roomType){

            },

            viewRoomType(roomType){

            },

            getImageUrl(roomType){
                let imageMedia = roomType.media.find(m => fileResolvers.isImage(m));
                if(imageMedia) return urlResolvers.getImage(imageMedia.file);
                return false;
            },

        },

        created(){

        },
    }
</script>