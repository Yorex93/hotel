<template>
  <div>
    <v-container>
      <v-layout row wrap>

      </v-layout>
    </v-container>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import { fileResolvers, urlResolvers } from '../../services/helpers'
    export default {
        name: 'HotelFacility',
        props: {
            'facilities': { type: Array, required: true },
            'canModify': { type: Boolean, default: false },
        },

        data: () => ({

        }),

        validations: {},

        methods: {
            // ...mapActions(''),
            isImage(data){
                return fileResolvers.isImage(data);
            },
            getImageUrl(data){
                return urlResolvers.getImage(data);
            }
        },

        computed: {
            // ...mapGetters('', []),
        },

        created() {},

        watch: {},

    }
</script>

<style>

</style>