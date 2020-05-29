<closable-card v-if="!!selected_provinsi" header="Provinsi Terpilih:" v-on:close="selected_provinsi = null">
    <h5>@{{ selected_provinsi.name }}</h5>
</closable-card>

<data-table v-bind.sync="kota_kabupaten" ref="table" v-model="selected_kota_kabupaten">
    <div slot="form">
        <b-form-group v-bind="kota_kabupaten.form.feedback('provinsi_id')">
            <b slot="label">Provinsi:</b>
            <ajax-select
                label="name"
                placeholder="Pilih Provinsi"
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                v-model="kota_kabupaten.form.provinsi"
                v-bind:key-value.sync="kota_kabupaten.form.provinsi_id"
                v-on:select="kota_kabupaten.form.errors.clear('provinsi_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="kota_kabupaten.form.feedback('name')">
            <b slot="label">Name:</b>
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="kota_kabupaten.form.name"
                >
            </input>
        </b-form-group>

    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kota_kabupaten: {
                sortBy: `provinsi`,
                url   : `{{ action('Master\Wilayah\KotaKabupatenController@index') }}`,
                params: {
                    provinsi: null
                },
                fields: [{
                    label    : 'Nama Provinsi',
                    key      : 'provinsi',
                    sortable : true,
                    formatter: provinsi => !provinsi ? '' : provinsi.name
                },{
                    key      : 'name',
                    sortable : true,
                }],
                form: new Form({
                    name       : null,
                    provinsi_id: null
                },{
                    provinsi   : null,
                })
            }
        }
    },
});
</script>
@endpush