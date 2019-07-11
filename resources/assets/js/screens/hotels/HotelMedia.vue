<template>
  <div>

  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        props: ['hotel'],

        name: 'HotelMedia',
        data: () => ({
          media: []
        }),

        validations: {},

        methods: {
            // ...mapActions(''),
        },

        computed: {
            // ...mapGetters('', []),
        },

        created() {},

        watch: {
            hotel(value){
                if(value){
                    this.media = value.media;
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