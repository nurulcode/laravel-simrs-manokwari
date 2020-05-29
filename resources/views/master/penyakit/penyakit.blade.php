<closable-card v-if="!!selected_kelompok" header="Kelompok Terpilih:" v-on:close="selected_kelompok = null">
    <h5>
        @{{ selected_kelompok.kode }} -
        @{{ selected_kelompok.icd }}  -
        @{{ selected_kelompok.uraian }}
    </h5>
</closable-card>

<data-table v-bind.sync="penyakit" ref="table">
    <div slot="form">
        <b-form-group label="Klasifikasi Penyakit:" v-bind="penyakit.form.feedback('klasifikasi_id')">
            <ajax-select
                deselect-label=""
                label="kode"
                placeholder="Pilih Klasifikasi Penyakit"
                url="{{ action('Master\Penyakit\KlasifikasiPenyakitController@index') }}"
                select-label=""
                v-model="penyakit.form.klasifikasi"
                v-bind:key-value.sync="penyakit.form.klasifikasi_id"
                v-on:change="penyakit.form.errors.clear('klasifikasi_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                </template>
            </ajax-select>
        </b-form-group>
        <b-form-group v-if="penyakit.form.klasifikasi" label="Kelompok Penyakit:" v-bind="penyakit.form.feedback('kelompok_id')">
            <ajax-select
                :url="`${penyakit.form.klasifikasi.path}/kelompok`"
                deselect-label=""
                label="kode"
                placeholder="Pilih Kelompok Penyakit"
                select-label=""
                v-model="penyakit.form.kelompok"
                v-bind:key-value.sync="penyakit.form.kelompok_id"
                v-on:change="penyakit.form.errors.clear('kelompok_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                </template>
            </ajax-select>
        </b-form-group>
        <b-form-group label="ICD:" v-bind="penyakit.form.feedback('icd')">
            <input
                class="form-control"
                name="icd"
                placeholder="ICD"
                type="text"
                v-model="penyakit.form.icd"
                >
            </input>
        </b-form-group>
        <b-form-group label="Uraian:" v-bind="penyakit.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="penyakit.form.uraian"
                >
            </input>
        </b-form-group>
    </div>
    <template slot="kelompok" slot-scope="{value}">
        @{{ value.icd }} -
        @{{ value.uraian }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            penyakit: {
                sortBy: `icd`,
                url   : `{{ action('Master\Penyakit\PenyakitController@index') }}`,
                params: {
                    kelompok: null
                },
                fields: [{
                    key     : 'kelompok'
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
                    icd           : null,
                    kelompok_id   : null,
                    klasifikasi_id: null
                },{
                    klasifikasi: null,
                    kelompok   : null
                }),
            }
        }
    }
});
</script>
@endpush