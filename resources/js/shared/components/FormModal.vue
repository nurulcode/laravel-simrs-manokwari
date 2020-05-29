<script>
import Form from '../form';
import LoadingOverlay  from './LoadingOverlay';

import bModal from 'bootstrap-vue/es/components/modal/modal';
import bForm  from 'bootstrap-vue/es/components/form/form';

export default {
    render: function (createElement) {
        return createElement(bModal, {
            on: {
                hidden: this.hidden,
                ok    : this.submit
            },
            props: {
                ...this.$attrs
            },
            ref: 'modal'
        }, [
            createElement(bForm, {
                on: {
                    keydown: this.keydown,
                    submit : this.submit
                }
            }, this.$slots.default),
            createElement(LoadingOverlay, {
                style: {
                    display: this.isLoading ? 'flex' : 'none',
                  },
            })
        ]);
    },
    data() {
        return {
            isLoading: false,
            action   : null,
            promise: {
                resolve: () => {},
                reject : () => {}
            },
        }
    },
    methods: {
        show() {
            this.$refs.modal.show();

            return new Promise((resolve, reject) => {
                this.promise.resolve = resolve;
                this.promise.reject  = reject;
            });
        },
        hide() {
            this.$refs.modal.hide();
        },
        post(url) {
            this.method = 'post';
            this.action = url;

            return this.show();
        },
        put(url) {
            this.method = 'put';
            this.action = url;

            return this.show();
        },
        delete(url) {
            this.method = 'delete';
            this.action = url;

            return this.show();
        },
        submit(event) {
            event.preventDefault();

            this.isLoading = true;

            this.form.submit(this.method, this.action)
                .takeAtLeast(500)
                .then(response => {
                    this.isLoading = false;

                    this.hide();

                    this.promise.resolve(response);
                }).
                catch(error => {
                    this.isLoading = false;

                    if (error.response && error.response.status != 422) {
                        this.hide();

                        this.promise.reject(error);
                    }
                });
        },
        keydown(event) {
            this.form.errors.clear(event.target.name);

            return event.keyCode == 13 ? this.submit(event) : event;
        },
        hidden() {
            this.action = null;

            this.form.reset();

            this.$emit('hidden');
        }

    },
    props: {
        form: {
            type    : Form,
            required: true
        },
    }
}
</script>