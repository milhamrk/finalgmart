import Vue from 'vue'
import Vuex from 'vuex'
import auth from './stores/auth.js'

import firebase from 'firebase'
import 'firebase/firestore'

import users from './storee/users.js'
import conversations from './storee/conversations.js'

import config from './config'

firebase.initializeApp(config)

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        users,
        conversations
    },
    state: {
        token: localStorage.getItem('token'),
        errors: [],
        db: firebase.firestore(),
        loaded : false
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store