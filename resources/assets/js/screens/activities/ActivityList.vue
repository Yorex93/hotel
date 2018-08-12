<template>
  <div>
    <h2 class="primary-text mb-3">
      Activities
    </h2>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {

        name: 'ActivityList',
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