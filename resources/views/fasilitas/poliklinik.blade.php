<data-table v-bind.sync="poliklinik" ref="table" v-model="selected_poliklinik">
    <div slot="form">
        <b-form-group label="Kode:" v-bind="poliklinik.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="poliklinik.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="poliklinik.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="poliklinik.form.nama"
                >
            </input>
        </b-form-group>
        <b-form-group label="Jenis:" v-bind="poliklinik.form.feedback('jenis')">
             <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Jenis Poliklinik"
                select-label=""
                url="{{ action('Master\JenisPoliklinikController@index') }}"
                v-model="poliklinik.form.jenis"
                v-bind:key-value.sync="poliklinik.form.jenis_id"
                v-on:select="poliklinik.form.errors.clear('jenis_id')"
                >
            </ajax-select>
        </b-form-group>
    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            poliklinik: {
                sortBy: 'kode',
                url   : `{{ action('Fasilitas\PoliklinikController@index') }}`,
                fields: [{
                    key      : 'kode',
                    sortable : true,
                    formatter: item => item.toUpperCase()
                },{
                    key      : 'nama',
                    sortable : true,
                }, {
                    key      : 'jenis',
                    formatter: item => item.uraian
                }],
                form: new Form({
                    kode    : null,
                    nama    : null,
                    jenis_id: null,
                }, {
                    jenis: null,
                }),
            }
        }
    },
});
</script>
@endpush