<template>
    <v-row>
        <v-col cols="12">
            <v-row justify="center" align="center">
                <v-col cols="8">
                    <template v-if="account && transactions && currencies">
                        <v-card class="elevation-8">
                            <v-toolbar
                                color="primary"
                                dark
                            >
                                <v-toolbar-title>Welcome, {{ account.user.name }}</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn
                                    class=mr-2
                                    color="warning"
                                    @click="newPayment"
                                    small
                                >New Payment</v-btn>
                                <v-btn
                                    color="error"
                                    @click="logout"
                                    small
                                >Logout</v-btn>
                            </v-toolbar>
                            <v-card-text class="pb-0">
                                <v-row class="mb-4">
                                    <v-col cols="3">
                                        <v-card
                                            color="red darken-3"
                                            dark
                                        >
                                            <v-card-text class="text-h6 white--text">
                                                Account Code
                                            </v-card-text>
                                            <v-card-actions class="text-subtitle-1 font-weight-bold pt-0 justify-center">
                                                {{ account.id }}
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                    <v-col cols="3">
                                        <v-card
                                            color="green darken-4"
                                            dark
                                        >
                                            <v-card-text class="text-h6 white--text">
                                                Balance
                                            </v-card-text>
                                            <v-card-actions class="text-subtitle-1 font-weight-bold pt-0 justify-center">
                                                {{ currencies.main.sign + (Math.round(account.balance*100)/100) }}
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-card
                                            color="purple darken-1"
                                            dark
                                        >
                                            <v-card-actions class="text-subtitle-1 font-weight-bold pb-1 pt-0 justify-center">
                                                <v-simple-table dense class="transparent">
                                                    <template v-slot:default>
                                                        <thead>
                                                        <tr>
                                                            <th v-for="item in currencies_table.headers" :key="'header-'+item.name" class="text-left">{{ item.name }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="item in currencies.total" :key="'curr-'+item.id">
                                                            <td>{{ item.name }}</td>
                                                            <td>{{ item.abb }}</td>
                                                            <td>{{ item.sign }}</td>
                                                            <td>{{ item.main ? 'Yes':'No' }}</td>
                                                            <td>{{ item.rate }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                        <v-spacer></v-spacer>
                        <v-card class="elevation-8">
                            <v-toolbar
                                color="primary"
                                dark
                            >
                                <v-toolbar-title>Transactions History</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-data-table
                                    :headers="transactions_table.headers"
                                    :items="transactions"
                                    :items-per-page="10"
                                    class="elevation-1"
                                >
                                    <template v-slot:item.from.user.name="{ item }">
                                        {{ item.from.user.name + ' Account' }}
                                    </template>
                                    <template v-slot:item.to.user.name="{ item }">
                                        {{ item.to.user.name + ' Account' }}
                                    </template>
                                    <template v-slot:item.amount="{ item }">
                                        <span v-if="item.from.id == account.id" class="red--text">
                                            {{ currencies.main.sign + item.amount }}
                                        </span>
                                        <span v-else class="green--text">
                                            {{ currencies.main.sign + item.amount }}
                                        </span>
                                    </template>
                                    <template v-slot:item.created_at="{ item }">
                                        {{ dateTimeFormat(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-card-text>
                        </v-card>
                    </template>
                    <template v-else>
                        <v-skeleton-loader
                            width="100%"
                            type="card"
                            :tile="true"
                            class="mx-auto mb-5"
                        ></v-skeleton-loader>
                        <v-skeleton-loader
                            width="100%"
                            type="table"
                            :tile="true"
                            class="mx-auto mt-5"
                        ></v-skeleton-loader>
                    </template>
                </v-col>
            </v-row>
        </v-col>

        <v-dialog v-model="payment_box_show" persistent max-width="600px">
            <v-card>
            <v-card-title class="yellow darken-4 white--text pa-auto">
                <span class="headline">New Payment</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                <v-row>
                    <v-col cols="12">
                    <v-text-field v-model="payment_form.to_id" label="Account Code*" type="number" min="0" step="1" required clearable></v-text-field>
                    </v-col>
                    <v-col cols="2">
                        <v-select
                            class="align-center justify center"
                            v-model="payment_form.selected_rate"
                            :items="currencies.select"
                            required
                        ></v-select>
                    </v-col>
                    <v-col cols="10">
                    <v-text-field
                        v-model="payment_form.amount"
                        label="Amount*"
                        :hint="amountHint"
                        persistent-hint
                        type="number"
                        min="0.01" step="0.01"
                        required
                    ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                    <v-text-field v-model="payment_form.details" label="Details" hint="Details of payment" clearable></v-text-field>
                    </v-col>
                </v-row>
                </v-container>
                <small class="red--text">*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-btn color="red darken-1" text @click="payment_box_show = false">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="orange darken-1" text @click="resetForm">Reset</v-btn>
                <v-btn color="green darken-1" text @click="onSubmit" :loading="submitLoading" :disabled="submitLoading">Save</v-btn>
            </v-card-actions>
            </v-card>
        </v-dialog>
        <v-snackbar
            v-model="payment_bool"
            bottom
            :color="pyament_type ? 'success':'error'"
        >
            {{ payment_msg }}

            <template v-slot:action="{ attrs }">
            <v-btn
                dark
                text
                small
                v-bind="attrs"
                timeout="5000"
                @click="payment_bool = false"
            >
                Close
            </v-btn>
            </template>
        </v-snackbar>
    </v-row>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'Account',
        computed: {
            currencies: function(){
                let temp_curr = this.$store.getters.getCurrencies;
                if(!temp_curr){
                    return false;
                }
                let final_object = {
                    main: {},
                    total: [],
                    select: [],
                };
                for(let i=0; i < temp_curr.model.length ; ++i){
                    if(!!temp_curr.model[i].main){
                        final_object.main = temp_curr.model[i];
                    }
                    temp_curr.model[i]['rate'] = temp_curr.rates[i];
                    final_object.total.push(temp_curr.model[i]);
                    final_object.select.push({text: temp_curr.model[i].sign, value: temp_curr.model[i].rate})
                }
                return final_object;
            },
            amountHint: function(){
                if(!!this.currencies && !!this.payment_form.amount){
                    return 'Equals '+this.currencies.main.sign+((Math.round(this.payment_form.amount*this.payment_form.selected_rate*100))/100);
                }else{
                    return '';
                }
            },
            ...mapGetters({
                account: 'getUser',
                transactions: 'getTransactions',
            }),
        },
        data() {
            return {
                payment_box_show: false,
                submitLoading: false,
                payment_form: {
                    to_id: null,
                    selected_rate: 1,
                    amount: null,
                    details: null,
                },

                currencies_table: {
                    headers: [
                        {name: 'Currency',},
                        {name: 'ABB'},
                        {name: 'Sign'},
                        {name: 'Main',},
                        {name: 'RateToMain'},
                    ],
                },

                transactions_table: {
                    headers: [
                        {text: 'ID', value: 'id', sortable: true},
                        {text: 'From', value: 'from.user.name', sortable: true},
                        {text: 'To', value: 'to.user.name', sortable: true},
                        {text: 'Amount', value: 'amount', sortable: true},
                        {text: 'Details', value: 'details', sortable: true},
                        {text: 'DateTime', value: 'created_at', sortable: true},
                    ],
                },

                payment_bool: false,
                pyament_type: false,
                payment_msg: null,
            };
        },

        methods: {
            logout: function() {
                this.$store.dispatch('logout');
                this.$router.replace({ name: 'dashboard'});
            },
            newPayment: function(){
                this.payment_box_show = !this.payment_box_show;
            },
            onSubmit: function() {
                // I could use libraries like Vuelidate to validate user data in front end
                // But It really was not necessary for a test project, however we have server-side validation

                if(this.submitLoading){
                    return false;
                }
                this.submitLoading = true;

                let form = {
                    id: this.account.id,
                    to_id: this.payment_form.to_id,
                    amount: (Math.round(this.payment_form.amount*this.payment_form.selected_rate*100))/100,
                    details: this.payment_form.details,
                };

                this.$store.dispatch('newPayment', form)
                    .then(resp => {
                            this.submitLoading = false;
                            this.payment_box_show = false;
                            this.payment_bool = true;
                            this.pyament_type = resp.data.status;
                            if(resp.data.status){
                                this.payment_msg = 'Payment has been done successfully!';
                            }else{
                                // Errors are arrays
                                this.payment_msg = resp.data.errors.join('\n');
                            }
                            // We can save data here, but i wanted to do it in Vuex way
                        })
                        .catch(err => {
                            // Lets handle the possible errors
                            this.submitLoading = false;
                            this.payment_box_show = false;
                            if(err.response.status === 404){
                                this.$router.replace({name: 'notFound'});
                            }else{
                                this.payment_bool = true;
                                this.pyament_type = false;
                                this.payment_msg = this.$store.state.serverError;
                            }
                        });
            },
            resetForm: function(){
                this.payment_form.to_id = null;
                this.payment_form.selected_rate = 1;
                this.payment_form.amount = null;
                this.payment_form.details = null;
            },
            dateTimeFormat: function(datetime){
                return moment(datetime).clone().format('MMMM Do YYYY, h:mm A');
            }
        },

        created: function(){
            // We check for loggedIn user data, if it doesnt exist, we call for an action to retrieve data
            if(!this.$store.getters['getUser']){
                    this.$store.dispatch('loadUser', {id: this.$route.params.id})
                        .then(resp => {
                            // If 'status==false' it means requested account is not in database
                            if(!resp.data.status){
                                this.$router.replace({ name: 'dashboard'});
                            }
                            // We can save data here, but i wanted to do it in Vuex way
                        })
                        .catch(err => {
                            if(err.response.status === 404){
                                this.$router.replace({name: 'notFound'});
                            }
                        });
            }

            // We check for transactions of loggedIn user, if they dont exist, we call for an action to retrieve data
            if(!this.$store.getters['getTransactions']){
                    this.$store.dispatch('loadTransactions', {id: this.$route.params.id})
                        // We can save data here, but i wanted to do it in Vuex way
                        .catch(err => {
                            if(err.response.status === 404){
                                this.$router.replace({name: 'notFound'});
                            }
                        });
            }

            // At last we get current currencies and their exchange rates
            // Ofcorse we can get these data earlier, but i think if they change each moment, its better to get them as late as possible
            // Also Server broadcast new exchange rates as they update | but this feature is not
            if(!this.$store.getters['getCurrencies']){
                    this.$store.dispatch('loadCurrencies')
                        // We can save data here, but i wanted to do it in Vuex way
                        .catch(err => {
                            if(err.response.status === 404){
                                this.$router.replace({name: 'notFound'});
                            }
                        });
            }
        },
    };

</script>
