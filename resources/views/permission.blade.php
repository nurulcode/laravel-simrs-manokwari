@extends('layouts.single-card')

@section('title', 'Permission Management')

@section('card')
    <data-table v-bind.sync="permission" ref="table" no-delete no-add-button-text>
        <div slot="form">
            <b-form-group label="Name:" v-bind="permission.form.feedback('name')">
                <input
                    class="form-control"
                    disabled
                    name="name"
                    placeholder="Name"
                    type="text"
                    :value="permission.form.name"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Description:" v-bind="permission.form.feedback('description')">
                <input
                    class="form-control"
                    name="description"
                    placeholder="Description"
                    type="text"
                    v-model="permission.form.description"
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
            permission: {
                url   : `{{ action('PermissionController@index') }}`,
                sortBy: 'name',
                fields: [
                    {
                        key     : 'name',
                        sortable: true,
                    },
                    {
                        key     : 'description',
                    },
                ],
                form: new Form({
                    name       : null,
                    description: null,
                })
            }
        }
    },
});
</script>
@endpush
