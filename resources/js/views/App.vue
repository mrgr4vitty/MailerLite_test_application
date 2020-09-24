<template>
    <v-app id="sandbox">
        <!-- <v-navigation-drawer clipped permanent app overflow></v-navigation-drawer> -->
        <v-app-bar clipped-left app color="primary" class="white--text">
            <v-toolbar-title>MailerLite Test App</v-toolbar-title>
        </v-app-bar>
        <v-main class="blue-grey lighten-5">
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
        <v-footer app color="primary" class="white--text">
            <span class="px-4">By Danial Hayati</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        name: "App",
        props: {
            'input_object_accounts': [Object, Array],

            'input_api_assets': String,
            'input_api_dashboard': String,
            'input_api_currencies': String,
        },
        data: function() {
            return {

            };
        },
        created: function() {
            let data = {
                urls: {
                    resources: this.input_api_assets,
                    api: {
                        dashboard: this.input_api_dashboard,
                        accounts: '/api/accounts',
                        currencies: this.input_api_currencies,
                    },
                },
                data: {
                    accounts: this.input_object_accounts,
                    currencies: null,
                    loggedIn_user: null,
                    loggedIn_user_transactions: null,
                }
            };
            this.$store.commit('set_initial_app_data', data);
        },
    };
</script>

<style scoped>
    .container {
        margin: 0 auto;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .title {
        font-family: sans-serif;
        display: block;
        font-weight: 600;
        font-size: 100px;
        letter-spacing: 1px;
    }
    .subtitle {
        font-weight: 300;
        font-size: 42px;
        word-spacing: 5px;
        padding-bottom: 15px;
    }
    .links {
        padding-top: 15px;
    }
</style>
