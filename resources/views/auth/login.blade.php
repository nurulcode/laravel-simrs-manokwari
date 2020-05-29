@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card-group">
    @component('components.card', ['class' => 'p-4'])
        <h1>Login</h1>
        <p class="text-muted">Sign In to your account</p>

        <form v-on:submit.prevent="submit">
            <b-form-group v-bind="form.feedback('username')">
                <div class="input-group">
                    <input
                        class="form-control"
                        name="username"
                        placeholder="{{ __('Username') }}"
                        tabindex=1
                        v-model="form.username">
                    </input>
                    <div class="input-group-append">
                        <button class="btn btn-secondary"> <i class="icon-user"></i></button>
                    </div>
                </div>
            </b-form-group>
            <b-form-group v-bind="form.feedback('password')">
                <div class="input-group">
                    <input
                        class="form-control"
                        name="password"
                        placeholder="{{ __('Password') }}"
                        tabindex=2
                        v-bind:type="show_password ? `text`: `password`"
                        v-model="form.password">
                    </input>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" v-on:click.prevent="show_password = !show_password">
                            <i :class="show_password ? `icon-lock` : `icon-eye`"></i>
                        </button>
                    </div>
                </div>
            </b-form-group>
        </form>

        <button class="px-4 btn btn-primary" v-on:click.prevent="submit"> {{ __('Login') }} </button>

        <loading-overlay v-show="submiting"></loading-overlay>

    @endcomponent

    @component('components.card', ['class' => 'text-white bg-primary py-5 d-md-down-none text-center'])
        @include('auth.authlogo')
    @endcomponent

</div>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            alert: {
                dismissible: true,
                message    : null,
                show       : false,
                variant    : null
            },
            show_password: false,
            submiting    : false,
            form: new Form({
                username: '',
                password: '',
                remember: true
            })
        }
    },
    methods: {
        submit() {
            this.submiting = true;

            this.form.post(`{{ route('login') }}`)
                .then(this.redirect)
                .catch(this.exception);
        },
        redirect(response) {
            window.location.replace(response.request.responseURL);
        },
        exception(error) {
            if (error.response.status == 419) {
                return stickAlert('419 Authentication Timeout: Refresh Page');
            }

            this.submiting = false;
        },
    }
});
</script>
@endpush
