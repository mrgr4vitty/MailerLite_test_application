<template>
    <v-row>
        <v-col cols="12">
            <v-row justify="center" align="center">
                <v-col cols="4">
                    <v-card class="elevation-8 pa-4">
                        <div class="ma-5 text-h1">404!</div>
                        <v-btn
                            color="primary"
                            @click="redirect"
                        >Login</v-btn>
                    </v-card>
                </v-col>
            </v-row>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        name: "notFound",
        methods:{
            redirect: function(){
                this.$router.replace({ name: 'dashboard'})
            }
        }
    }
</script>

<style scoped>

</style>
