
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from  './routes'
import store from './store';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

Vue.use(VueRouter);
Vue.use(Toast);
Vue.config.productionTip = false


// views-----------------------------------------------------------------------------------------------------
Vue.component('login', require('./views/Login.vue').default);
Vue.component('employee-view', require('./views/EmployeeView.vue').default);
Vue.component('admin-view', require('./views/AdminView.vue').default);
Vue.component('main-view', require('./views/MainView.vue').default);

// general components-----------------------------------------------------------------------------------------------------
Vue.component('navbar', require('./components/Navbar.vue').default);


// employee components-----------------------------------------------------------------------------------------------------
Vue.component('employee-sidebar', require('./components/EmployeeSidebar.vue').default);


// admin components-----------------------------------------------------------------------------------------------------
Vue.component('admin-sidebar', require('./components/AdminSidebar.vue').default);


const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store
});
