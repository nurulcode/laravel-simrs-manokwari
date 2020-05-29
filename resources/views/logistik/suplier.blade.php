@extends('layouts.single-card')

@section('title', 'Suplier Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table" >
        <div slot="form">
            <b-form-group v-bind="resource.form.feedback('nama')">
                <b slot="label">Nama:</b>
                <input
                    class="form-control"
                    name="nama"
                    placeholder="Nama"
                    type="text"
                    v-model="resource.form.nama"
                    >
                </input>
            </b-form-group>
            <b-form-group v-bind="resource.form.feedback('alamat')">
                <b slot="label">Alamat:</b>
                <textarea
                    class="form-control"
                    name="alamat"
                    placeholder="Alamat"
                    type="text"
                    v-model="resource.form.alamat"
                    >
                </textarea>
            </b-form-group>
            <b-form-group v-bind="resource.form.feedback('no_telepon')">
                <b slot="label">No Telepon:</b>
                <input
                    class="form-control"
                    name="no_telepon"
                    placeholder="No Telepon"
                    type="text"
                    v-model="resource.form.no_telepon"
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
            resource: {
                url   : `{{ action('Logistik\SuplierController@index') }}`,
                sortBy: 'nama',
                fields: [{
                    key      : 'nama',
                    sortable : true,
                },{
                    key      : 'alamat',
                    sortable : true,
                },{
                    key      : 'no_telepon',
                    label    : 'Nomor Telepon'
                }],
                form: new Form({
                    nama      : null,
                    alamat    : null,
                    no_telepon: null
                }),
            }
        }
    },
});
</script>
@endpush
