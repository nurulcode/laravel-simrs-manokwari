@extends('layouts.single-card')

@section('title', 'User Management')

@section('card')
    <data-table v-bind.sync="user" ref="table"
        @cannot('create', App\Models\User::class)
            no-add-button-text
        @endcannot
        >
        <template slot="name" slot-scope="{item, value}">
            <p> @{{ value }} </p>

            <template v-for="role in item.roles">
                <span class="badge badge-danger mr-1" v-if="role.name == 'superadmin'">
                    @{{ role.description }}
                </span>
                <span class="badge badge-primary mr-1" v-else>
                    @{{ role.description }}
                </span>
            </template>

        </template>
        <template slot='active' slot-scope="{item}">
            <button
                :disabled="item.__editable == false"
                title="Active"
                type="button"
                class="btn btn-primary"
                v-if="item.active"
                v-on:click.prevent="toggle(item)"
                >
                <i class="fa fa-check"></i>
            </button>
            <button
                :disabled="item.__editable == false"
                class="btn btn-danger"
                title="Inactive"
                v-else
                v-on:click="toggle(item)"
                >
                <i class="fa fa-times"></i>
            </button>
        </template>
        <div slot="form">
            <b-form-group label="Name:" v-bind="user.form.feedback('name')">
                <input
                    class="form-control"
                    name="name"
                    placeholder="Name"
                    type="text"
                    v-model="user.form.name"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Username:" v-bind="user.form.feedback('username')">
                <input
                    class="form-control"
                    name="username"
                    placeholder="Username"
                    type="text"
                    v-model="user.form.username"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Email:" v-bind="user.form.feedback('email')">
                <input
                    class="form-control"
                    name="email"
                    placeholder="Email"
                    type="text"
                    v-model="user.form.email"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Roles:" v-bind="user.form.feedback('roles')">
                <ajax-select
                    :multiple="true"
                    :filter="hideSuperUser"
                    url="{{ action('RoleController@index') }}"
                    label="description"
                    placeholder="Pilih Roles"
                    v-model="user.form.roles"
                    >
                </ajax-select>
            </b-form-group>
            <hr>
            <b-form-group label="Password:" v-bind="user.form.feedback('password')">
                <input
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    type="password"
                    v-model="user.form.password"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Konfirmasi Password:"
                v-bind="user.form.feedback('password_confirmation')">
                <input
                    class="form-control"
                    name="password_confirmation"
                    placeholder="Konfirmasi Password"
                    type="password"
                    v-model="user.form.password_confirmation"
                    >
                </input>
            </b-form-group>

        </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            user: {
                url   : `{{ action('UserController@index') }}`,
                sortBy: 'username',
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                    {
                        key     : 'username',
                        sortable: true,
                    },
                    {
                        key     : 'last_login',
                        sortable: true,
                    },
                    {
                        key  : 'active',
                        class: 'text-center'
                    }
                ],
                form: new Form({
                    active  : true,
                    name    : null,
                    username: null,
                    email   : null,
                    password: null,
                    password_confirmation: null,
                    roles   : [],
                })
            }
        }
    },
    methods: {
        toggle(item) {
            axios.put(`${item.path}/toggle`)
                .then(response => {
                    window.flash(response.data.message, response.data.status);

                    this.$refs.table.refresh();
                }).catch(error => {
                    this.flashError(error.response);

                    this.$refs.table.refresh();
                });
        },
        flashError(response) {
            switch(true) {
                case response.data.message:
                    window.flash(response.data.message, 'error', 10000);
                    break;
                case response.status < 500:
                    window.flash(response.statusText, 'error', 10000);
                    break;
                default:
                    window.flash('Something went wrong!', 'error', 10000);
                    break;
            }
        },
        hideSuperUser(role) {
            return role.name !== 'superadmin';
        }
    }
});
</script>
@endpush
