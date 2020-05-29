@extends('layouts.single-card')

@section('title', 'Master Daftar Kasus Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table">
        <div slot="form">
            <b-form-group v-bind="resource.form.feedback('kode')">
                <b slot="label">Kode:</b>
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Kode"
                    type="text"
                    v-model="resource.form.kode"
                    >
                </input>
            </b-form-group>
            <b-form-group v-bind="resource.form.feedback('uraian')">
                <b slot="label">Uraian:</b>
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="resource.form.uraian"
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
                url   : `{{ action('Master\KasusController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({
                    kode  : null,
                    uraian: null
                }),
            }
        }
    },
});
</script>
@endpush
