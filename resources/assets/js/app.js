
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import swal from 'sweetalert2'

// CommonJS
window.swal = require('sweetalert2')
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 /**
vue router
 */
// require('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');

import Vue from 'vue'
import VueRouter from 'vue-router'

// Vue.use(VueRouter);
//
// Vue.component('example', require('./components/Example.vue'));
//
// // let Navtop = require('./components/NavTop.vue');
// let Navside = require('./components/NavSide.vue');
//
// // add user
//
// let Userindex = require('./components/user/Index.vue');
// let Addnewuser = require('./components/user/NewUser.vue');
//
// const routes = [
//   { path: '/360admin/users/all', component: Userindex },
//   { path: '/360admin/users/add-new', component: Addnewuser }
// ];
//
// const router = new VueRouter({
// 	mode: 'history',
//   	routes: routes
// });
//
// const app = new Vue({
//     el: '#app',
//     router: router,
//     components:{ Navside }
// });


// OPT ONLY
Vue.component('opt-social-links', require('./components/options/OptSocialLink.vue'));

const opt = new Vue({
    el: '#opt',
});
