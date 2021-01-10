
require('./bootstrap');
window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('authentication-log', require('./components/operator/AuthenticationLog.vue').default);

const app = new Vue({
    el: '#app',
});
