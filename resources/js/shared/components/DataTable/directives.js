const HANDLER  = '_outside_click_handler';

export default {
    clickOutside: {
        bind: (el, binding, vnode) => {
            const callback = binding.value;

            if (typeof callback !== 'function') {
                Vue.util.warn(
                    'v-' + binding.name + '="' + binding.expression +
                    '" expects a function value, ' +
                    'got ' + callback
                );
                return;
            }

            el[HANDLER] = function (event) {
                // here I check that click was outside the el and his childrens
                if (!(el == event.target || el.contains(event.target))) {
                    // and if it did, call method provided in attribute value
                    // vnode.context[binding.expression](event);
                    return callback.call(event);
                }
            };

            document.body.addEventListener('click', el[HANDLER])
        },
        unbind: (el) => {
            document.body.removeEventListener('click', el[HANDLER])
        }
    }
}