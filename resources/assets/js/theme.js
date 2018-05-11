
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 /**
vue router
 */
 window.swal = require('sweetalert2')

import Vue from 'vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import Vuex from 'vuex'

Vue.use(Toasted);
Vue.use(Vuex)
Vue.use(VueRouter);

// var EventBus = new Vue();
// Object.defineProperties(Vue.prototype, {
//     $eventBus: {
//         get: function () {
//             return EventBus;
//         }
//     }
// });

var store = new Vuex.Store({
    state: {
        balls: "ball ball ball"
    },
    getters:{
        getBalls(state){
            return state.balls;
        }
    },
    mutations: {


        }
})

export default store;

Vue.component('login', require('./components/front/LoginMod.vue'));
Vue.component('register', require('./components/front/RegisterMod.vue'));
Vue.component('upload-form', require('./components/front/media/SaveImage.vue'));
Vue.component('custom-vue-avatar', require('./components/vueCustomAvatar.vue'));
Vue.component('user-detail', require('./components/UserDetail.vue'));
Vue.component('video-url', require('./components/company/VideoUrl.vue'));
Vue.component('services', require('./components/company/Services.vue'));
Vue.component('social-number', require('./components/company/SocialNumber.vue'));
Vue.component('branches', require('./components/company/Branches.vue'));


const app = new Vue({
    el: '#user',
    store: store
});

// https://github.com/devjin0617/vuejs-eventbus-example