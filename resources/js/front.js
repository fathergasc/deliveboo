window.Vue = require('vue')

import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App)
});
