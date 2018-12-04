
import './bootstrap';
import router from './routes';
import VModal from 'vue-js-modal'
Vue.use(VModal, { dynamic: true })

Vue.component('search', require('./components/Search.vue'));
Vue.component('flover', require('./components/Flover.vue'));
Vue.component('footer-rodo', require('./components/Footer.vue'));
Vue.component('finishedbtn', require('./components/FinishedBtn.vue'));
Vue.component('logo', require('./components/Logo.vue'));
Vue.component('modalshops', require('./components/Modalshops.vue'));
const app = new Vue({
    el: '#app',
    router: router
});
