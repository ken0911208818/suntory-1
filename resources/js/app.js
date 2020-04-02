/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('liqueur-test',require('./components/test.vue').default);
Vue.component('liqueur-text',require('./components/Text.vue').default);
Vue.component('content-editor', require('./components/vue2editor.vue').default);

// Vue.component('products-component', require('./components/FrontProducts.vue').default);
// Vue.component('cart-component', require('./components/FrontCart.vue').default);
Vue.component('checkout-area', require('./components/FrontCheckout.vue').default);

Vue.component('liqueur-main', require('./components/liqueur.vue').default);
Vue.component('liqueur-story',require('./components/liqueur-story.vue').default);
Vue.component('liqueur-attitude', require('./components/liqueur-attitude.vue').default);
Vue.component('liqueur-sure', require('./components/liqueur-sure.vue').default);
Vue.component('liqueur-method', require('./components/liqueur-method.vue').default);
Vue.component('liqueur-product', require('./components/liqueur-product.vue').default);

Vue.component('shop-component', require('./components/shop.vue').default);
Vue.component('order-component', require('./components/order.vue').default);
Vue.component('checkout-table', require('./components/checkout_table.vue').default);
Vue.component('order-finish', require('./components/orderfinish.vue').default);

/**
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vuetify from "vuetify";
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify);
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
