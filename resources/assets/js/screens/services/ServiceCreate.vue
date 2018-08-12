<template>
  <div>
    <h2 class="primary-text mb-3">
      Create Service
    </h2>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {

        name: 'ServiceCreate',
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