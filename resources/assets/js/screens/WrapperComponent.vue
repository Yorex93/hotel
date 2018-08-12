<template>
    <v-app light>
        <v-navigation-drawer app v-model="drawer" width="300">
            <v-toolbar flat class="transparent">
                <v-list class="pa-0">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img src="https://randomuser.me/api/portraits/men/88.jpg" >
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ currentUser ? currentUser.name : ''}}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-toolbar>
            <v-list class="pt-0" dense>
                <v-divider></v-divider>

                <v-list-tile v-for="item in items" :to="{name: item.link}" :key="item.name" :exact="item.exact">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.name }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="logout">
                    <v-list-tile-action>
                        <v-icon>power_settings_new</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Logout
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Administration</v-toolbar-title>
        </v-toolbar>

        <v-content>
            <v-container fluid>
                <router-view class="animated fadeIn"></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
        <vue-toastr></vue-toastr>
    </v-app>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    export default {
        name: 'WrapperComponent',
        data: () => ({
            items: [
                { name: 'Dashboard', icon: 'home', link: 'dashboard', exact: true },
                { name: 'Hotels', icon: 'location_city', link: 'hotels' },
                { name: 'Room Types', icon: 'hotel', link: 'roomTypes' },
                { name: 'Rooms', icon: 'hotel', link: 'rooms' },
                { name: 'Activities', icon: 'beach_access', link: 'activities' },
                { name: 'Facilities', icon: 'hot_tub', link: 'facilities' },
                { name: 'Services', icon: 'room_service', link: 'services' },
                { name: 'Bookings', icon: 'event', link: 'bookings' },
                { name: 'Payments', icon: 'credit_card', link: 'payments' },
                { name: 'Coupons', icon: 'card_giftcard', link: 'coupons' },
                { name: 'Users', icon: 'persons', link: 'users' },
                { name: 'Settings', icon: 'settings', link: 'settings' },
            ],
            drawer: null
        }),
        methods: {
            ...mapActions({ userLogout : 'user/logout'}),
            ...mapActions({ fetchHotels : 'hotel/fetchHotels' }),
            ...mapActions({ fetchCountries : 'location/fetchCountries' }),
            ...mapActions({ fetchRoomTypes : 'room/fetchRoomTypes' }),
            logout(){
                this.userLogout({router: this.$router});
            }
        },
        computed: {
            ...mapGetters('user', ['currentUser']),
        },

        created(){
            this.fetchHotels();
            this.fetchCountries();
            this.fetchRoomTypes();
            this.$toastr.defaultProgressBar = false;
            this.$toastr.defaultTimeout = 3000;
        },

        watch:{
            $route (to, from){
                console.log("route changed");
            }
        }
    }
</script>
