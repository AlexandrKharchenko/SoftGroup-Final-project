import ru from 'vee-validate/dist/locale/ru';
import VeeValidate, { Validator } from 'vee-validate';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Echo from "laravel-echo"



var moment = require('moment');

var toast = require('jquery-toast-plugin');

//var socket = io('http://laravel.iused.top');




window.Echo = new Echo ({
     broadcaster: 'socket.io',
     host: window.location.hostname
});





console.log(window.location.hostname);
console.log(window.Echo);

//window.Echo.join('notify');

window.Echo.channel('notify')
    .listen("UserUpdateProfile", function () {

        console.log('test YES');
    });









Validator.addLocale(ru);
Validator.installDateTimeValidators(moment)

Vue.component('login-form', require('./components/Login.vue'));
Vue.component('like-profile', require('./components/Like.vue'));
Vue.component('register-form', require('./components/Register.vue'));
Vue.component('user-profile', require('./components/UserProfile.vue'));

Vue.use(VeeValidate, {

    locale: 'ru',
}); // good to go.



const app = new Vue({
    el: '#app'
});
