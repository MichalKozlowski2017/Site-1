import lodash from 'lodash';
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Vuebar from 'vuebar';
Vue.use(Vuebar);
window._ = lodash;
window.Vue = Vue;
Vue.use(VueRouter);
import VeeValidate from 'vee-validate';
import { ErrorBag } from 'vee-validate';
window.$ = window.jQuery = require('jquery');
Vue.use(VeeValidate);

// const bag = new ErrorBag();

// import { Validator } from 'vee-validate';
// const dictionary = {
//   pl: {
// 	messages:{
// 	  required: () => 'To pole jest wymagane.',
// 	  email: () => 'Wprowadź poprawny adres email',
// 	  digits: () => 'Telefon musi mieć 9 cyfr.',
// 	  size: () => 'Plik musi być mniejszy niż 5MB.',
// 	  url: () => 'Wpisz prawidłowy link.'
// 	}
//   }
// };

// Validator.updateDictionary(dictionary);

// const validator = new Validator();
// validator.setLocale('pl');

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// IE fix
require('es6-promise').polyfill();

require('./utils');
