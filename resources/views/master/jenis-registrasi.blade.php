@extends('layouts.single-card')

@section('title', 'Master Jenis Registrasi Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table" >
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
            <b-form-group v-bind="resource.form.feedback('kategori')">
                <b slot="label">Kategori Registrasi:</b>
                <b-form-select
                    :options="{{ json_encode(App\Enums\KategoriRegistrasi::toSelectOptions()) }}"
                    v-on:change="resource.errors.clear('kategori')"
                    v-model="resource.form.kategori">
                    <template slot="first">
                        <option :value="null" disabled>Pilih Kategori Registrasi</option>
                    </template>
                </b-form-select>
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
                url   : `{{ action('Master\JenisRegistrasiController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({
                    uraian  : null,
                    kategori: null
                }),
            }
        }
    },
});
</script>
@endpush
