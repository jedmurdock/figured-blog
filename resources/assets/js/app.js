
require('./bootstrap');

window.Vue = require('vue');

Vue.component('paginate', require('vuejs-paginate'));
Vue.component('post-stream', require('./components/PostStream.vue'));
Vue.component('post-view', require('./components/PostView.vue'));
Vue.component('post-edit', require('./components/PostEdit.vue'));

const app = new Vue({
    el: '#app'
});
