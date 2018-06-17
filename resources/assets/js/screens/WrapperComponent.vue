<template>
    <v-app>
        <v-navigation-drawer app>
            <v-toolbar flat class="transparent">
                <v-list class="pa-0">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img src="https://randomuser.me/api/portraits/men/88.jpg" >
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ env.MIX_APP_NAME }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-toolbar>
            <v-list class="pt-0" dense>
                <v-divider></v-divider>

                <v-list-tile v-for="item in items" :to="item.link" :key="item.name" :exact="item.exact">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.name }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app></v-toolbar>

        <v-content>
            <v-container fluid>
                <router-view class="animated fadeIn"></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>

<script>
    export default {
        name: 'WrapperComponent',
        data: () => ({
            items: [
                { name: 'Dashboard', icon: 'home', link: '/admin', exact: true },
                { name: 'Properties', icon: 'location_city', link: '/admin/properties' },
                { name: 'Partners', icon: 'group', link: '/admin/partners' },
            ],
            env: process.env
        })
    }
</script>
