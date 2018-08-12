<template>
  <div>
    <h2 class="primary-text mb-3">
      Edit Coupon
    </h2>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {

        name: 'CouponEdit',
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