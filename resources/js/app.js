require('./bootstrap');

window.Vue = require('vue');

//Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import store from './store'

import App from './App.vue'

const app = new Vue({
    el: '#app',
    render: h => h(App),
    store,
});