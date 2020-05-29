@extends('layouts.single-card')

@section('title', 'Master Pemeriksaan Umum Management')

@section('card')
    <data-table v-bind.sync="resource" ref="table">
        <div slot="form">
            <b-form-group v-bind="resource.form.feedback('kode')">
                <b slot="label">Kode:</b>
                <input
                    class="form-control"
                    name="kode"
                    placeholder="Uraian"
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
            <b-form-group v-bind="resource.form.feedback('periode')">
                <b slot="label">Periode</b>
                <b-form-select
                    :options="{{ json_encode(App\Enums\PeriodePemeriksaan::toSelectArray()) }}"
                    v-model="resource.form.periode"
                    v-on:change="resource.form.errors.clear('periode')"
                >
                    <option slot="first" :value="null" disabled>Pilih Periode Pemeriksaan</option>
                </b-form-select>
            </b-form-group>
            <b-form-group label="Kelompok Pemeriksaan:" v-bind="resource.form.feedback('parent_id')">
                <ajax-select
                    :url="resource.url"
                    label="uraian"
                    placeholder="Pilih Kelompok Pemeriksaan"
                    v-model="resource.form.parent"
                    v-bind:key-value.sync="resource.form.parent_id"
                    v-on:change="resource.form.errors.clear('parent_id')"
                    >
                </ajax-select>
            </b-form-group>
        </div>
        <template slot="uraian" slot-scope="{item, value}">
            @{{ value }}
            <p class="text-muted" v-if="item.parent">@{{ item.parent.uraian }}</p>
        </template>
    </data-table>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            resource: {
                url   : `{{ action('Master\PemeriksaanUmumController@index') }}`,
                sortBy: 'kode',
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                }, {
                    key      : 'satuan'
                }],
                form: new Form({
                    kode     : null,
                    uraian   : null,
                    satuan   : null,
                    periode  : null,
                    parent_id: null
                }, {
                    parent   : null
                }),
            }
        }
    },
});
</script>
@endpush
