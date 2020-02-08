import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
        token: localStorage.getItem('token'),
    },
    mutations:{

        retrieveToken(state, token) {
            state.token = token;
        },    
        destroyToken(state) {
            state.token = null
        }

    },
    actions: {

        retrieveToken(context, credentials) {

                axios.post('/api/login', {
                email: credentials.email,
                password: credentials.password,
                })
                .then(response => {
                    const token = response.data.token;        
                    localStorage.setItem('token', token);
                    context.commit('retrieveToken', token);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error);
                    reject(error);
                })
            
        },

        destroyToken(context) {
    
            if (context.getters.loggedIn) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
                axios.post('/api/logout')
                .then(response => {
                    localStorage.removeItem('token');
                    context.commit('destroyToken');
                })
                .catch(error => {
                    localStorage.removeItem('token');
                    context.commit('destroyToken');
                })
            }
        },
        
    },
    getters: {
        loggedIn(state) {
            return state.token !== null
          },
    }

});