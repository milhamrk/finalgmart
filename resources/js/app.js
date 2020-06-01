// require('./bootstrap');

// window.Vue = require('vue');

import Vue from 'vue'
import Vuex from 'vuex'

import BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2'

Vue.use(VueSweetalert2)
Vue.use(BootstrapVue)
Vue.use(Vuex)

import router from './router.js'
import store from './store.js'
import App from './App.vue'

new Vue({
   el: '#dw',
    router,
    store,
    components: {
        App
    }
})
