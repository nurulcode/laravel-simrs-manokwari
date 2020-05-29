<closable-card v-if="!!selected_jabatan" header="Jabatan Terpilih:"
    v-on:close="selected_jabatan = null">
    <h5>@{{ selected_jabatan.uraian }}</h5>
</closable-card>

<closable-card v-if="!!selected_kualifikasi" header="Kualifikasi Terpilih:"
    v-on:close="selected_kualifikasi = null">
    <h5>@{{ selected_kualifikasi.uraian }}</h5>
</closable-card>

<data-table v-bind.sync="pegawai" ref="table_pegawai" >
    <div slot="form">
        <b-form-group v-bind="pegawai.form.feedback('nama')">
            <b slot="label">Nama:</b>
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="pegawai.form.nama"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Tempat Lahir:" v-bind="pegawai.form.feedback('tempat_lahir')">
                    <input
                        class="form-control"
                        name="tempat_lahir"
                        placeholder="Tempat Lahir"
                        type="text"
                        v-model="pegawai.form.tempat_lahir"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Tanggal Lahir:" v-bind="pegawai.form.feedback('tanggal_lahir')">
                    <date-picker
                        alt-format="d/m/Y"
                        :max-date="new Date()"
                        v-model="pegawai.form.tanggal_lahir"
                        v-on:input="pegawai.form.errors.clear('tanggal_lahir')">
                    </date-picker>
                </b-form-group>

            </div>
        </div>
        <b-form-group v-bind="pegawai.form.feedback('jenis_kelamin')">
            <b slot="label">Jenis Kelamin:</b>
            <b-form-select
                :options="{{ json_encode(App\Enums\JenisKelamin::toSelectOptions()) }}"
                v-on:change="pegawai.form.errors.clear('jenis_kelamin')"
                v-model="pegawai.form.jenis_kelamin">
                <template slot="first">
                    <option :value="null" disabled>Pilih Jenis Kelamin</option>
                </template>
            </b-form-select>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Jabatan:" v-bind="pegawai.form.feedback('jabatan_id')">
                    <ajax-select
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Jabatan"
                        select-label=""
                        url="{{ action('Kepegawaian\JabatanController@index') }}"
                        v-model="pegawai.form.jabatan"
                        v-bind:key-value.sync="pegawai.form.jabatan_id"
                        v-on:select="pegawai.form.errors.clear('jabatan_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group v-bind="pegawai.form.feedback('kualifikasi_id')">
                    <b slot="label">Kualifikasi:</b>
                    <ajax-select
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Kualifikasi"
                        select-label=""
                        url="{{ action('Kepegawaian\KualifikasiController@index') }}"
                        v-model="pegawai.form.kualifikasi"
                        v-bind:key-value.sync="pegawai.form.kualifikasi_id"
                        v-on:select="pegawai.form.errors.clear('kualifikasi_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
        </div>
        <b-form-group label="Alamat:" v-bind="pegawai.form.feedback('alamat')">
            <textarea
                class="form-control"
                name="alamat"
                placeholder="Alamat"
                v-model="pegawai.form.alamat">
            </textarea>
        </b-form-group>
        <b-form-group label="Telepon:" v-bind="pegawai.form.feedback('telepon')">
            <input
                class="form-control"
                name="telepon"
                placeholder="Telepon"
                type="text"
                v-model="pegawai.form.telepon">
            </input>
        </b-form-group>
    </div>
    <template slot="kualifikasi" slot-scope="{value}">
        @{{ value.uraian.toUpperCase() }}
        <p class="text-muted"> @{{ value.kategori.uraian }} </p>
    </template>
    <template slot="jabatan" slot-scope="{value}" v-if="value">
        @{{ value.uraian.toUpperCase() }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pegawai: {
                url   : `{{ action('Kepegawaian\PegawaiController@index') }}`,
                sortBy: `nama`,
                params: {
                    kualifikasi: null,
                    jabatan    : null
                },
                fields: [{
                    key      : 'nama',
                    sortable : true,
                },{
                    key      : 'tanggal_lahir',
                    sortable : true,
                    formatter: tgl => tgl ? format(parse(tgl), 'DD/MM/YYYY') : '-',
                    thStyle  : {'min-width': '140px'}
                },{
                    key      : 'telepon',
                    label    : 'Nomor Telepon',
                    thStyle  : {'min-width': '140px'}
                },{
                    key      : 'jabatan'
                },{
                    key      : 'kualifikasi',
                }],
                form: new Form({
                    nama          : null,
                    tempat_lahir  : null,
                    tanggal_lahir : null,
                    jenis_kelamin : null,
                    alamat        : null,
                    telepon       : null,
                    kualifikasi_id: null,
                    jabatan_id    : null
                }, {
                    jabatan       : null,
                    kualifikasi   : null,
                }),
            }
        }
    },
});
</script>
@endpush
