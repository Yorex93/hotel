<template>
  <div>
    <h2 class="primary-text mb-3">
      Facilities
    </h2>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {

        name: 'FacilityList',
        data: () => ({

        }),

        validations: {},

        methods: {
            // ...mapActions(''),
        },

        computed: {
            // ...mapGetters('', []),
        },

        created() {},

        watch: {},

        beforeRouteLeave(to, from, next){
            next();
        }

    }
</script>

<style>

</style>