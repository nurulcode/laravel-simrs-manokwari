@extends('layouts.single-card')

@section('title', 'Master Jenis Laundry Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table">
        <div slot="form">
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
            <b-form-group label="Satuan:" v-bind="resource.form.feedback('satuan')">
                <input
                    class="form-control"
                    name="satuan"
                    placeholder="Uraian"
                    type="text"
                    v-model="resource.form.satuan"
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
                url   : `{{ action('Master\JenisLaundryController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                }, {
                    key      : 'satuan'
                }],
                form: new Form({
                    uraian   : null,
                    satuan   : null,
                }),
            }
        }
    },
});
</script>
@endpush
