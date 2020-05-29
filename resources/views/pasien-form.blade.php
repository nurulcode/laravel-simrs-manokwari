<div class="row">
    <div class="col">
        <b-form-group v-bind="form_pasien.feedback('no_rekam_medis')">
            <b slot="label">Nomor Rekam Medis:</b>
            <input
                :disabled="form_pasien.no_rekam_medis == null"
                class="form-control"
                name="no_rekam_medis"
                placeholder="Nomor Rekam Medis Akan Dibuat Secara Otomatis"
                type="text"
                v-model="form_pasien.no_rekam_medis"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="form_pasien.feedback('jenis_identitas_id')">
            <b slot="label">Jenis Identitas:</b>
            <ajax-select
                label="uraian"
                placeholder="Pilih Jenis Identitas"
                url="{{ action('Master\JenisIdentitasController@index') }}"
                v-model="form_pasien.jenis_identitas"
                v-bind:key-value.sync="form_pasien.jenis_identitas_id"
                v-on:select="form_pasien.errors.clear('jenis_identitas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="form_pasien.feedback('nomor_identitas')">
            <b slot="label">Nomor Identitas:</b>
            <input
                class="form-control"
                name="nomor_identitas"
                placeholder="Nomor Identitas"
                type="text"
                v-model="form_pasien.nomor_identitas"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="form_pasien.feedback('nama')">
            <b slot="label">Nama Pasien:</b>
            <input
                class="form-control"
                name="nama"
                placeholder="Nomor Identitas"
                type="text"
                v-model="form_pasien.nama"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group label="Tempat Lahir:" v-bind="form_pasien.feedback('tempat_lahir')">
                    <input
                        class="form-control"
                        name="tempat_lahir"
                        placeholder="Tempat Lahir"
                        type="text"
                        v-model="form_pasien.tempat_lahir">
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Tanggal Lahir:" v-bind="form_pasien.feedback('tanggal_lahir')">
                    <date-picker
                        alt-format="d/m/Y"
                        :max-date="new Date()"
                        v-model="form_pasien.tanggal_lahir"
                        v-on:input="form_pasien.errors.clear('tanggal_lahir')">
                    </date-picker>
                </b-form-group>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <b-form-group v-bind="form_pasien.feedback('jenis_kelamin')">
                    <b slot="label">Jenis Kelamin:</b>
                    <b-form-select
                        :options="{{ json_encode(App\Enums\JenisKelamin::toSelectOptions()) }}"
                        v-on:change="form_pasien.errors.clear('jenis_kelamin')"
                        v-model="form_pasien.jenis_kelamin">
                        <template slot="first">
                            <option :value="null" disabled>Pilih Jenis Kelamin</option>
                        </template>
                    </b-form-select>
                </b-form-group>
            </div>
            <div class="col-md-6">
                <b-form-group label="Golongan Darah:" v-bind="form_pasien.feedback('golongan_darah')">
                    <b-form-select
                        :options="{{ json_encode(App\Enums\GolonganDarah::toSelectOptions()) }}"
                        v-on:change="form_pasien.errors.clear('golongan_darah')"
                        v-model="form_pasien.golongan_darah"
                        >
                        <template slot="first">
                            <option :value="null" disabled>Pilih Golongan Darah</option>
                        </template>
                    </b-form-select>
                </b-form-group>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b-form-group label="Suku:" v-bind="form_pasien.feedback('suku_id')">
                    <ajax-select
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Suku"
                        select-label=""
                        sort-by="id"
                        url="{{ action('Master\SukuController@index') }}"
                        v-model="form_pasien.suku"
                        v-bind:key-value.sync="form_pasien.suku_id"
                        v-on:select="form_pasien.errors.clear('suku_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group label="Agama:" v-bind="form_pasien.feedback('agama_id')">
                    <ajax-select
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Agama"
                        select-label=""
                        sort-by="id"
                        url="{{ action('Master\AgamaController@index') }}"
                        v-model="form_pasien.agama"
                        v-bind:key-value.sync="form_pasien.agama_id"
                        v-on:select="form_pasien.errors.clear('agama_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
        </div>
    </div>
    <div class="col">
        <b-form-group label="Pendidikan:" v-bind="form_pasien.feedback('pendidikan_id')">
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Pendidikan"
                select-label=""
                sort-by="id"
                url="{{ action('Master\PendidikanController@index') }}"
                v-model="form_pasien.pendidikan"
                v-bind:key-value.sync="form_pasien.pendidikan_id"
                v-on:select="form_pasien.errors.clear('pendidikan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Pekerjaan:" v-bind="form_pasien.feedback('pekerjaan_id')">
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Pekerjaan"
                select-label=""
                sort-by="id"
                url="{{ action('Master\PekerjaanController@index') }}"
                v-model="form_pasien.pekerjaan"
                v-bind:key-value.sync="form_pasien.pekerjaan_id"
                v-on:select="form_pasien.errors.clear('pekerjaan_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group label="Provinsi:" v-bind="form_pasien.feedback('provinsi_id')">
            <ajax-select
                deselect-label=""
                label="name"
                placeholder="Pilih Provinsi"
                select-label=""
                url="{{ action('Master\Wilayah\ProvinsiController@index') }}"
                v-model="form_pasien.provinsi"
                v-bind:key-value.sync="form_pasien.provinsi_id"
                v-on:select="clearWilayah(['kota_kabupaten', 'kecamatan', 'kelurahan'])"
                v-on:change="form_pasien.errors.clear('provinsi_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group label="Kota/Kabupaten:" v-bind="form_pasien.feedback('kota_kabupaten_id')"
            v-if="form_pasien.provinsi">
            <ajax-select
                deselect-label=""
                label="name"
                placeholder="Pilih Kota/Kabupaten"
                select-label=""
                url="{{ action('Master\Wilayah\KotaKabupatenController@index') }}"
                :params="{provinsi: form_pasien.provinsi_id}"
                v-model="form_pasien.kota_kabupaten"
                v-bind:key-value.sync="form_pasien.kota_kabupaten_id"
                v-on:select="clearWilayah(['kecamatan', 'kelurahan'])"
                v-on:change="form_pasien.errors.clear('kota_kabupaten_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group label="Kecamatan:" v-bind="form_pasien.feedback('kecamatan_id')"
            v-if="form_pasien.kota_kabupaten">
            <ajax-select
                deselect-label=""
                label="name"
                placeholder="Pilih Kecamatan"
                select-label=""
                url="{{ action('Master\Wilayah\KecamatanController@index') }}"
                :params="{kota_kabupaten: form_pasien.kota_kabupaten_id}"
                v-model="form_pasien.kecamatan"
                v-on:select="clearWilayah(['kelurahan'])"
                v-bind:key-value.sync="form_pasien.kecamatan_id"
                v-on:change="form_pasien.errors.clear('kecamatan_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group label="Kelurahan:" v-bind="form_pasien.feedback('kelurahan_id')"
            v-if="form_pasien.kecamatan">
            <ajax-select
                deselect-label=""
                label="name"
                placeholder="Pilih Kelurahan"
                select-label=""
                url="{{ action('Master\Wilayah\KelurahanController@index') }}"
                :params="{kecamatan: form_pasien.kecamatan_id }"
                v-model="form_pasien.kelurahan"
                v-bind:key-value.sync="form_pasien.kelurahan_id"
                v-on:select="form_pasien.errors.clear('kelurahan_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group label="Alamat:" v-bind="form_pasien.feedback('alamat')">
            <textarea
                class="form-control"
                name="alamat"
                placeholder="Alamat"
                v-model="form_pasien.alamat">
            </textarea>
        </b-form-group>
        <b-form-group label="Telepon:" v-bind="form_pasien.feedback('telepon')">
            <input
                class="form-control"
                name="telepon"
                placeholder="Telepon"
                type="text"
                v-model="form_pasien.telepon">
            </input>
        </b-form-group>
    </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <b-form-group label="Nama Ayah:" v-bind="form_pasien.feedback('nama_ayah')">
            <input
                class="form-control"
                name="nama_ayah"
                placeholder="Nama Ayah"
                type="text"
                v-model="form_pasien.nama_ayah">
            </input>
        </b-form-group>
        <b-form-group label="Nama Ibu:" v-bind="form_pasien.feedback('nama_ibu')">
            <input
                class="form-control"
                name="nama_ibu"
                placeholder="Nama Ibu"
                type="text"
                v-model="form_pasien.nama_ibu">
            </input>
        </b-form-group>
        <b-form-group label="Status Pernikahan:" v-bind="form_pasien.feedback('status_pernikahan')">
            <b-form-select
                :options="{{ json_encode(App\Enums\StatusPernikahan::toSelectOptions()) }}"
                v-model="form_pasien.status_pernikahan"
                v-on:change="form_pasien.errors.clear('status_pernikahan')"
                >
                <template slot="first">
                    <option :value="null" disabled>Pilih Status Pernikahan</option>
                </template>
            </b-form-select>
        </b-form-group>
        <b-form-group label="Nama Pasangan:" v-bind="form_pasien.feedback('nama_pasangan')">
            <input
                class="form-control"
                name="nama_pasangan"
                placeholder="Nama Pasangan"
                type="text"
                v-model="form_pasien.nama_pasangan">
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Alamat Keluarga:" v-bind="form_pasien.feedback('alamat')">
            <textarea
                class="form-control"
                name="alamat"
                placeholder="Alamat Keluarga"
                v-model="form_pasien.alamat">
            </textarea>
        </b-form-group>

        <b-form-group label="Telepon Keluarga:" v-bind="form_pasien.feedback('telepon_keluarga')">
            <input
                class="form-control"
                name="telepon_keluarga"
                placeholder="Telepon Keluarga"
                type="text"
                v-model="form_pasien.telepon_keluarga">
            </input>
        </b-form-group>
    </div>
</div>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_pasien: new Form({
                agama_id          : null,
                alamat            : null,
                golongan_darah    : null,
                jenis_identitas_id: null,
                jenis_kelamin     : null,
                nama              : null,
                nama_ayah         : null,
                nama_ibu          : null,
                nama_pasangan     : null,
                no_rekam_medis    : null,
                nomor_identitas   : null,
                pendidikan_id     : null,
                pekerjaan_id      : null,
                provinsi_id       : 91,
                kota_kabupaten_id : 9105,
                kecamatan_id      : null,
                kelurahan_id      : null,
                suku_id           : null,
                status_pernikahan : null,
                tanggal_registrasi: null,
                tanggal_lahir     : null,
                telepon           : null,
                tempat_lahir      : null
            },{
                agama             : null,
                jenis_identitas   : null,
                pekerjaan         : null,
                pendidikan        : null,
                provinsi          : null,
                kota_kabupaten    : null,
                kecamatan         : null,
                kelurahan         : null,
                suku              : null,
            }),
        }
    },
    mounted() {
        this.form_pasien.setDefault('provinsi', @json(App\Models\Master\Wilayah\Provinsi::find(91)));
        this.form_pasien.setDefault('kota_kabupaten', @json(App\Models\Master\Wilayah\KotaKabupaten::find(9105)));
    },
    methods: {
        clearWilayah(list) {
            list.forEach(level => this.form_pasien[level] = null);
        }
    }
});
</script>
@endpush
