<closable-card v-if="!!selected_kota_kabupaten"
    header="Kota/Kabupaten Terpilih:"
    v-on:close="selected_kota_kabupaten = null">
    <h5>@{{ selected_kota_kabupaten.name }}, @{{ selected_kota_kabupaten.provinsi.name }}</h5>
</closable-card>

<data-table v-bind.sync="kecamatan" ref="table" v-model="selected_kecamatan">
    <div slot="form">
        <b-form-group v-bind="kecamatan.form.feedback('provinsi_id')">
            <b slot="label">Provinsi:</b>
            <ajax-select
                placeholder="Pilih Provinsi"
                label="name"
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                v-model="kecamatan.form.provinsi"
                v-bind:key-value.sync="kecamatan.form.provinsi_id"
                v-on:select="kecamatan.form.errors.clear('provinsi_id')"
                v-on:input="kecamatan.form.kota_kabupaten = null"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-if="kecamatan.form.provinsi" v-bind="kecamatan.form.feedback('kota_kabupaten_id')">
            <b slot="label">Kota/Kabupaten:</b>
            <ajax-select
                :params="{provinsi: kecamatan.form.provinsi_id}"
                url="{{ action('Master\Wilayah\KotaKabupatenController@index') }}"
                label="name"
                placeholder="Pilih Kota/Kabupaten"
                v-model="kecamatan.form.kota_kabupaten"
                v-bind:key-value.sync="kecamatan.form.kota_kabupaten_id"
                v-on:select="kotakabupaten.form.errors.clear('kota_kabupaten_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="kecamatan.form.feedback('name')">
            <b slot="label">Name:</b>
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="kecamatan.form.name"
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
            kecamatan: {
                sortBy: `provinsi`,
                url   : `{{ action('Master\Wilayah\KecamatanController@index') }}`,
                params: {
                    kota_kabupaten: null
                },
                fields: [{
                    key      : 'provinsi',
                    label    : 'Nama Provinsi',
                    sortable : true,
                    formatter: provinsi => !provinsi ? '' : provinsi.name
                },{
                    label    : 'Nama Kota/Kabupaten',
                    key      : 'kota_kabupaten',
                    sortable : true,
                    formatter: kota_kabupaten => !kota_kabupaten ? '' : kota_kabupaten.name
                },{
                    key      : 'name',
                    sortable : true,
                }],
                form: new Form({
                    name             : null,
                    kota_kabupaten_id: null,
                    provinsi_id      : null,
                },{
                    kota_kabupaten   : null,
                    provinsi         : null
                })
            }
        }
    },
});
</script>
@endpush