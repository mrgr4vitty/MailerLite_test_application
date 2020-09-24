import Vue from 'vue';
import Vuex from 'vuex';

// Importing store methods
import mutations from './mutations';
import actions from './actions';

// Importing store modules


Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        app: {
            urls: {
                resources: '',
                api: {
                    dashboard: '',
                    accounts: '',
                    currencies: '',
                },
            },
            data: {
                accounts: {},
                currencies: null,
                loggedIn_user: null,
                loggedIn_user_transactions: null,
            }
        },
        serverError: 'Server error! Please contact Danial :)',
    },
    getters : {
        getUser: function(state){
            return state.app.data.loggedIn_user;
        },
        getTransactions: function(state){
            return state.app.data.loggedIn_user_transactions;
        },
        getCurrencies: function(state){
            return state.app.data.currencies;
        },
        getUrls: function(state){
            return state.app.urls;
        },
        getAccounts: function(state){
            return state.app.data.accounts;
        },
    },
    mutations: mutations,
    actions: actions,
    modules: {
        //
    }
});

export default store;
