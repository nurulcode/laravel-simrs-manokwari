/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import PopperJs from 'popper.js';
import Vue from 'vue';
import PerfectScrollbar from 'perfect-scrollbar';

import Form from './shared/form';

try {
    window.events           = new Vue();
    window.Popper           = PopperJs;
    window.Form             = Form;
    window.escapeRegExp     = require('lodash.escaperegexp');
    window.filter           = require('lodash.filter');
    window.debounce         = require('lodash.debounce');
    window.PerfectScrollbar = PerfectScrollbar;

    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('./__global');
require('./shared/__alert');
require('./shared/__promise_throttle');
