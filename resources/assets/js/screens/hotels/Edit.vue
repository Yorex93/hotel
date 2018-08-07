<template>
  <div>
    <h2 class="primary-text mb-3">
      {{ crudType === 'CREATE' ? 'Creating Hotel ': 'Editing Hotel ' }}
      <span class="teal--text">{{ hotel.name }}</span>
    </h2>

    <v-form v-model="valid">
      <v-container>
        <v-layout row wrap>
          <v-flex xs12 sm6>
            <v-text-field
                v-model="hotel.name"
                label="Hotel Name"
                required
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
                v-model="hotel.sub_title"
                label="Sub Title"
                required
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm12>
            <v-textarea
                v-model="hotel.description"
                label="Description"
                required
            />
          </v-flex>

          <v-btn :disabled="!valid" @click.prevent="createHotel(hotel)">
            submit
          </v-btn>
        </v-layout>
      </v-container>
    </v-form>
  </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: 'EditHotel',
        data: () => ({
            valid: true,
            crudType: '',
            hotel: {
                name: '',
                sub_title: '',
                description: '',
                email: '',
                phone: '',
                website: '',
                parent_hotel_id: '',
                is_active: true,
                location: {
                    name: '',
                    address: '',
                    city: '',
                    phone: '',
                    email: '',
                    state_id: '',
                    country_id: '',
                    latitude: '',
                    longitude: '',
                    contactPerson: {
                        email: '',
                        first_name: '',
                        middle_name: '',
                        last_name: '',
                        phone_number: '',
                        title: '',
                        is_public: false
                    }
                },
                media: []
            },
        }),

        methods: {
            ...mapActions('hotel', ['createHotel', 'updateHotel'])
        },

        computed: {
            ...mapGetters('hotel',
              ['getHotelById', 'getHotels', 'isCreating', 'isUpdating', 'creatingError', 'updatingError']
            )
        },

        created() {
            if (this.$route.params.id) {
                this.crudType = 'UPDATE';
                this.hotel = this.getHotelById(this.$route.params.id);
            } else {
                this.crudType = 'CREATE';
            }
        }
    }
</script>

<style>

</style>