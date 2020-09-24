<template>
    <v-row>
        <v-col cols="12">
            <v-row justify="center" align="center">
                <v-col cols="4">
                    <v-card class="elevation-8">
                        <v-toolbar
                            color="primary"
                            dark
                        >
                            <v-toolbar-title>Login form</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text class="pb-0">
                            <v-form>
                                <v-select
                                    v-model="account"
                                    :items="items"
                                    label="Select Account"
                                    solo
                                ></v-select>
                            </v-form>
                        </v-card-text>
                        <v-card-actions class="pt-0 justify-center">
                            <v-btn
                                color="primary"
                                @click="login"
                            >Login</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-col>
        <v-snackbar
            v-model="message"
            bottom
            color="error"
        >
            Please select an account!

            <template v-slot:action="{ attrs }">
            <v-btn
                dark
                text
                small
                v-bind="attrs"
                @click="message = false"
            >
                Close
            </v-btn>
            </template>
        </v-snackbar>
    </v-row>
</template>

<script>
    export default {
    name: "Login",
    computed: {
        items: function(){
            return this.$store.getters.getAccounts;
        }
    },
    data(){
        return {
            account: null,
            message: false,
        }
    },
    methods: {
        login: function(){
            if(this.account === null){
                this.message = true;
                return false;
            }
            this.$router.push({ name: 'accounts', params: { id: this.account } })
        }
    },
}
</script>

<style scoped>

</style>
