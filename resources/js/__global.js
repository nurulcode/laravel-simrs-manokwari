import Vue from 'vue';
import idLocale from 'date-fns/locale/id';

window.addHours     = require('date-fns/add_hours');
window.subDays      = require('date-fns/sub_days');
window.startOfToday = require('date-fns/start_of_today');
window.parse        = require('date-fns/parse');
window.format       = require('date-fns/format');

window.date_time = function (value) {
    return format(parse(value), 'DD/MM/YYYY HH:mm', {locale: idLocale});
}

Vue.filter('date_time', function (value) {
    return date_time(value);
});