import Vue from 'vue';
export default {
    set_initial_app_data(state, data){
        state.app = data;
    },
    logout(state){
        // Clearing main state Data
        state.app.data.loggedIn_user = null;
        state.app.data.loggedIn_user_transactions = null;
        state.app.data.currencies = null;

        // Clearing Echo token and unsubscribe from subscribed channels | We don't have this in our project
    },
    loggedIn_user(state, data){
        state.app.data.loggedIn_user = data;
    },
    loggedIn_user_transactions(state, data){
        state.app.data.loggedIn_user_transactions = data;
    },
    setCurrencies(state, data){
        //state.app.data.currencies = data;
        Vue.set(state.app.data, 'currencies', data );
    },
    newTransaction(state, data){
        state.app.data.loggedIn_user_transactions.push(data.model);
        Vue.set(state.app.data.loggedIn_user, 'balance', data.newBalance );
    },
};
