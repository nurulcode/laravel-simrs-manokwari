<closable-card v-if="!!selected_klasifikasi" header="Klasifikasi Terpilih:" v-on:close="selected_klasifikasi = null">
    <h5>@{{ selected_klasifikasi.kode }}, @{{ selected_klasifikasi.uraian }}</h5>
</closable-card>

<data-table v-bind.sync="kelompok" ref="table" v-model="selected_kelompok">
    <div slot="form">
        <b-form-group label="Klasifikasi Penyakit:" v-bind="kelompok.form.feedback('klasifikasi_id')">
            <ajax-select
                label="uraian"
                placeholder="Pilih Klasifikasi Penyakit"
                url="{{ action('Master\Penyakit\KlasifikasiPenyakitController@index') }}"
                v-model="kelompok.form.klasifikasi"
                v-bind:key-value.sync="kelompok.form.parent_id"
                v-on:change="kelompok.form.errors.clear('parent_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kode:" v-bind="kelompok.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="kelompok.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="ICD:" v-bind="kelompok.form.feedback('icd')">
            <input
                class="form-control"
                name="icd"
                placeholder="ICD"
                type="text"
                v-model="kelompok.form.icd"
                >
            </input>
        </b-form-group>
        <b-form-group label="Uraian:" v-bind="kelompok.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="kelompok.form.uraian"
                >
            </input>
        </b-form-group>
    </div>
    <template slot="klasifikasi" slot-scope="{value}">
        @{{ value.kode }} - @{{ value.uraian }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kelompok: {
                sortBy: 'kode',
                url   : `{{ action('Master\Penyakit\KelompokPenyakitController@index') }}`,
                params: {
                    klasifikasi: null
                },
                fields: [{
                    key     : 'klasifikasi'
                },{
                    key     : 'kode',
                    label   : 'Kode DTD',
                    sortable: true,
                },{
                    key     : 'icd',
                    label   : 'ICD',
                    sortable: true,
                },{
                    key     : 'uraian',
                    sortable: true,
                }],
                form: new Form({
                    uraian        : null,
                    kode          : null,
                    icd           : null,
                    klasifikasi_id: null
                },{
                    klasifikasi   : null
                }),
            }
        }
    }
});
</script>
@endpush