<change-password inline-template ref="changepassword">
    <form-modal
        ref="modal"
        title="Ubah Password"
        v-bind:form='form'
        v-on:hidden='shown = false'
        >
        <b-form-group
            label="Password Saat Ini:"
            v-bind="form.feedback('current_password')"
            >
            <input
                :type="shown ? `password` : `text`"
                class="form-control"
                name="current_password"
                placeholder="Password Saat Ini"
                v-model="form.current_password"
                >
            </input>
        </b-form-group>
        <b-form-group
            label="Password Baru:"
            v-bind="form.feedback('password')"
            >
            <input
                :type="shown ? `password` : `text`"
                class="form-control"
                name="password"
                placeholder="Password Baru"
                v-model="form.password"
                >
            </input>
        </b-form-group>
        <b-form-group
            label="Konfirmasi Password:"
            v-bind="form.feedback('password_confirmation')"
            >
            <input
                :type="shown ? `password` : `text`"
                class="form-control"
                name="password"
                placeholder="Konfirmasi Password"
                v-model="form.password_confirmation"
                >
            </input>
        </b-form-group>
    </form-modal>
</change-password>

@push('javascripts')
<script>
window.inlines['change-password'] = {
    data() {
        return {
            form: new Form({
                current_password     : '',
                password             : '',
                password_confirmation: ''
            }),
            shown: false
        }
    },
    methods: {
        open() {
            this.shown = true;

            this.$refs.modal.put(`{{ route('user.password') }}`)
                .then(({data}) => {
                    window.flash(data.message, data.status);
                })
                .catch(({response}) => {
                    let data = response.data;

                    window.flash(data.message || response.statusText || 'Something went wrong!', 'error');
                })
        }
    }
};
</script>
@endpush