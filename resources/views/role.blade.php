@extends('layouts.single-card')

@section('title', 'Role Management')

@section('card')
    <data-table v-bind.sync="role" ref="table"
        @cannot('create', App\Models\Role::class)
            no-add-button-text
        @endcannot
        >
        <template slot="permissions" slot-scope="{item, value}">
            <template v-for="permission in value">
                <span class="badge badge-danger mr-1" v-if="permission.name == 'do_anything'">
                    @{{ permission.description }}
                </span>
                <span class="badge badge-primary mr-1" v-else>
                    @{{ permission.description }}
                </span>
            </template>
        </template>
        <div slot="form">
            <b-form-group label="Name:" v-bind="role.form.feedback('name')">
                <input
                    class="form-control"
                    name="name"
                    placeholder="Name"
                    type="text"
                    v-model="role.form.name"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Description:" v-bind="role.form.feedback('description')">
                <input
                    class="form-control"
                    name="description"
                    placeholder="Description"
                    type="text"
                    v-model="role.form.description"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Permissions:" v-bind="role.form.feedback('permissions')">
                <ajax-select
                    :multiple="true"
                    url="{{ action('PermissionController@index') }}"
                    label="description"
                    placeholder="Pilih Permissions"
                    v-model="role.form.permissions"
                    >
                </ajax-select>
            </b-form-group>
        </div>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            role: {
                url   : `{{ action('RoleController@index') }}`,
                sortBy: 'name',
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                    {
                        key     : 'description',
                    },
                    {
                        key     : 'permissions',
                    }
                ],
                form: new Form({
                    name       : null,
                    description: null,
                    permissions: []
                })
            }
        }
    },
});
</script>
@endpush
