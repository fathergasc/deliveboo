window.Vue = require('vue');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import router from './router.js';

import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
