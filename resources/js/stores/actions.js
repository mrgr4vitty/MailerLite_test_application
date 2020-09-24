export default {
    logout ({commit}){
        // First We create a PROMISE here for REAL logout task; Then we clear local TOKEN

        // Now we clear up Vuex
        commit('logout');
    },
    loadUser({commit}, options){
        // We run a http request with axios inside a promise to get data and then handle the response based on its status
        return new Promise((resolve, reject) => {
            axios({url: this.state.app.urls.api.accounts+'/'+options.id, method: 'GET'})
                .then(resp => {
                    commit('loggedIn_user', resp.data.model);
                    resolve(resp);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    loadTransactions({commit}, options){
        // We run a http request with axios inside a promise to get data and then handle the response based on its status
        return new Promise((resolve, reject) => {
            axios({url: this.state.app.urls.api.accounts+'/'+options.id+'/transactions', method: 'GET'})
                .then(resp => {
                    commit('loggedIn_user_transactions', resp.data.model);
                    resolve(resp);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    newPayment({commit}, payload){
        // We run a http request with axios inside a promise to send data and will wait for proper response
        return new Promise((resolve, reject) => {
            axios({url: this.state.app.urls.api.accounts+'/'+payload.id+'/transactions', method: 'POST', data: payload})
                .then(resp => {
                    if(resp.data.status){
                        commit('newTransaction', {model: resp.data.model, newBalance: resp.data.new_balance});
                    }
                    resolve(resp);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    loadCurrencies({commit}, options){
        // We run a http request with axios inside a promise to get data and then handle the response based on its status
        return new Promise((resolve, reject) => {
            axios({url: this.state.app.urls.api.currencies, method: 'GET'})
                .then(resp => {
                    commit('setCurrencies', {model: resp.data.model, rates: resp.data.rates});
                    resolve(resp);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
};
