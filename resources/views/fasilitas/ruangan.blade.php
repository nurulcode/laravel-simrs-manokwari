<closable-card v-if="!!selected_poliklinik" header="Poliklinik Terpilih:"
    v-on:close="selected_poliklinik = null">
    <h5>@{{ selected_poliklinik.nama }}</h5>
</closable-card>

<data-table v-bind.sync="ruangan" ref="table" v-model="selected_ruangan">
    <template slot="jenis" slot-scope="{value}">
        @{{ ruangan.jenis[value] }}
    </template>
    <template slot="kelas" slot-scope="{value}">
        @{{ ruangan.kelas[value] }}
    </template>
    <div slot="form">
        <b-form-group label="Poliklinik:" v-bind="ruangan.form.feedback('poliklinik_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Poliklinik"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="ruangan.form.poliklinik"
                v-bind:key-value.sync="ruangan.form.poliklinik_id"
                v-on:select="ruangan.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kode:" v-bind="ruangan.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="ruangan.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="ruangan.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="ruangan.form.nama"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Jenis:" v-bind="ruangan.form.feedback('jenis')">
                    <b-form-select
                        :options="{{ json_encode(App\Enums\JenisRuangan::toSelectOptions()) }}"
                        v-on:change="ruangan.errors.clear('jenis')"
                        v-model="ruangan.form.jenis">
                        <template slot="first">
                            <option :value="null" disabled>Pilih Jenis Ruangan</option>
                        </template>
                    </b-form-select>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Kelas:" v-bind="ruangan.form.feedback('kelas')">
                    <b-form-select
                        :options="{{ json_encode(App\Enums\KelasRuangan::toSelectOptions()) }}"
                        v-on:change="ruangan.errors.clear('kelas')"
                        v-model="ruangan.form.kelas">
                        <template slot="first">
                            <option :value="null" disabled>Pilih Kelas Ruangan</option>
                        </template>
                    </b-form-select>
                </b-form-group>
            </div>
        </div>
    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            ruangan: {
                jenis : @json(App\Enums\JenisRuangan::toSelectArray()),
                kelas : @json(App\Enums\KelasRuangan::toSelectArray()),
                sortBy: `nama`,
                url   : `{{ action('Fasilitas\RuanganController@index') }}`,
                params: {
                    poliklinik: null
                },
                fields: [{
                    key      : 'poliklinik',
                    sortable : true,
                    formatter: item => item.nama
                },{
                    key      : 'kode',
                    sortable : true,
                    formatter: item => item.toUpperCase()
                },{
                    key      : 'nama',
                    sortable : true,
                }, {
                    key      : 'kelas',
                },{
                    key      : 'jenis'
                }],
                form: new Form({
                    poliklinik_id: null,
                    kode         : null,
                    nama         : null,
                    jenis        : null,
                    kelas        : null,
                }, {
                    poliklinik   : null,
                }),
            }
        }
    },
});
</script>
@endpush