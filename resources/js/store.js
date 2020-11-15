import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        _token : document.querySelector("meta[name=csrf-token]").content,
        userName : document.querySelector('meta[name=username]') ? document.querySelector('meta[name=username]').content : null
    },
    mutations: {}
})

export default store