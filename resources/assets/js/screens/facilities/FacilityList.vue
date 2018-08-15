<template>
  <div>
    <h1 class="display-1 primary-text mb-3">Facilities</h1>
    <v-btn color="primary" dark class="ml-0 mb-2" @click.prevent="newFacility">New Facility </v-btn>
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
        <td>{{ props.item.icon }}</td>
        <td>{{ props.item.image }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click.prevent="viewFacility(props.item)">visibility</v-icon>
          <v-icon small class="mr-2" @click.prevent="editFacility(props.item)">edit</v-icon>
          <v-icon small @click.prevent="deleteFacility(props.item)">delete</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>

</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import { fileResolvers, urlResolvers } from '../../services/helpers';
    import facility from "../../store/modules/facility";
    export default {
        name: 'FacilityList',
        data: () => ({
            loading: false,
            totalFacilities: 0,
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: false,
                    value: 'id'
                },
                { text: 'Name', value: 'name' , sortable: false},
                { text: 'Icon', value: 'icon' , sortable: false},
                { text: 'Image', value: 'image' , sortable: false},
                { text: 'Creation Date', value: 'created_at' , sortable: false},
                { text: 'Actions', value: 'name' , sortable: false},
            ]
        }),

        computed: {
            ...mapGetters('facility', ['getFacilities']),
        },
        methods: {
            ...mapActions('facility', ['fetchFacilities']),
            editFacility(facility){
                if(facility){
                    this.$router.push({ name: 'editFacility' , params: { id: facility.id }});
                }
            },

            newFacility(){
                this.$router.push({ name: 'createFacility'});
            },

            deleteFacility(roomType){

            },

            viewFacility(roomType){

            },

            getImageUrl(facility){
                let imageMedia = facility.media.find(m => fileResolvers.isImage(m));
                if(imageMedia) return urlResolvers.getImage(imageMedia.file);
                return false;
            },

        },

        created(){

        },
    }
</script>