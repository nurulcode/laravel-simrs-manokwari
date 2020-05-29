@extends('kunjungan.create')

@section('title', 'Registrasi Pasien Rawat Inap')

@section('action', action('Perawatan\RawatInapController@store'))

@section('form')
<div class="row">
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('jenis_registrasi_id')">
            <b slot="label">Jenis Registrasi:</b>
            <b-form-select v-model="form_kunjungan.jenis_registrasi_id"
                v-on:change="form_kunjungan.errors.clear('jenis_registrasi_id')">
                <option :value="null" disabled>Pilih Jenis Registrasi</option>

                @foreach($jenis_registrasis as $registrasi)
                    <option :value="{{ $registrasi->id }}">{{ $registrasi->uraian }}</option>
                @endforeach

            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('poliklinik_id')">
            <b slot="label">Poliklinik Tujuan:</b>
            <b-form-select v-model="form_kunjungan.poliklinik_id"
                v-on:change="form_kunjungan.errors.clear('poliklinik_id')">
                <option :value="null" disabled>Pilih Poliklinik Tujuan</option>
                @foreach($polikliniks as $poliklinik)
                    <option :value="{{ $poliklinik->id }}">
                        {{ $poliklinik->kode }} - {{ $poliklinik->nama }}
                    </option>
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('kegiatan_id')">
            <b slot="label">Jenis Kegiatan:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Jenis Kegiatan"
                select-label=""
                url="{{ action('Master\KegiatanController@index') . '?kategori=' . $kategori_kegiatan }}"
                v-model="form_kunjungan.kegiatan"
                v-bind:key-value.sync="form_kunjungan.kegiatan_id"
                v-on:select="form_kunjungan.errors.clear('kegiatan_id')"
                >
            </ajax-select>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('ruangan_id')">
            <b slot="label">Ruang Rawat Inap:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih ruang rawat inap"
                select-label=""
                url="{{ action('Fasilitas\RuanganController@index') }}"
                v-model="form_kunjungan.ruangan"
                v-bind:key-value.sync="form_kunjungan.ruangan_id"
                v-on:select="form_kunjungan.errors.clear('ruangan_id')"
                >
            </ajax-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('kamar_id')">
            <b slot="label">Kamar:</b>
            <ajax-select
                :disabled="!form_kunjungan.ruangan_id"
                :params="{ruangan:form_kunjungan.ruangan_id}"
                deselect-label=""
                label="nama"
                placeholder="Pilih Kamar"
                select-label=""
                url="{{ action('Fasilitas\KamarController@index') }}"
                v-model="form_kunjungan.kamar"
                v-bind:key-value.sync="form_kunjungan.kamar_id"
                v-on:select="form_kunjungan.errors.clear('kamar_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.ruangan.nama }} - @{{ option.nama }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.ruangan.nama }} - @{{ option.nama }}</span>
                </template>
            </ajax-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('ranjang_id')">
            <b slot="label">Ranjang:</b>
            <ajax-select
                :disabled="!form_kunjungan.kamar_id"
                :params="{kamar:form_kunjungan.kamar_id,kosong:true}"
                deselect-label=""
                label="kode"
                placeholder="Pilih Ranjang"
                select-label=""
                url="{{ action('Fasilitas\RanjangController@index') }}"
                v-model="form_kunjungan.ranjang"
                v-bind:key-value.sync="form_kunjungan.ranjang_id"
                v-on:select="form_kunjungan.errors.clear('ranjang_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>
                        @{{ option.ruangan.nama }} -
                        @{{ option.kamar.nama }} -
                        @{{ option.kode }}
                    </span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>
                        @{{ option.ruangan.nama }} -
                        @{{ option.kamar.nama }} -
                        @{{ option.kode }}
                    </span>
                </template>
            </ajax-select>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('cara_penerimaan')">
            <b slot="label">Cara Penerimaan:</b>
            <b-form-select
                :options="{{ json_encode(App\Enums\CaraPenerimaan::toSelectOptions()) }}"
                v-on:change="form_kunjungan.errors.clear('cara_penerimaan')"
                v-model="form_kunjungan.cara_penerimaan">
                <template slot="first">
                    <option :value="null" disabled>Pilih Cara Penerimaan</option>
                </template>
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('aktifitas')">
            <b slot="label">Aktifitas:</b>
            <b-form-select
                :options="{{ json_encode(App\Enums\Aktifitas::toSelectOptions()) }}"
                v-on:change="form_kunjungan.errors.clear('aktifitas')"
                v-model="form_kunjungan.aktifitas">
                <template slot="first">
                    <option :value="null" disabled>Pilih Aktifitas</option>
                </template>
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col"></div>
</div>
@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_kunjungan: new Form({
                pasien_baru        : false,
                pasien_id          : null,
                nomor_kunjungan    : null,
                rujukan: {
                    jenis_id       : null,
                    asal           : null,
                    nomor          : null,
                    tanggal        : null
                },
                waktu_masuk        : null,
                aktifitas          : null,
                cara_pembayaran_id : null,
                cara_penerimaan    : null,
                sjp_nomor          : null,
                sjp_tanggal        : null,
                pj_nama            : null,
                pj_telepon         : null,
                kasus_id           : null,
                penyakit_id        : null,
                jenis_registrasi_id: null,
                poliklinik_id      : null,
                ruangan_id         : null,
                kamar_id           : null,
                ranjang_id         : null,
                kegiatan_id        : null
            },{
                jenis_registrasi   : null,
                jenis_rujukan      : null,
                kasus              : null,
                kegiatan           : null,
                pasien             : null,
                penyakit           : null,
                poliklinik         : null,
                ruangan            : null,
                kamar              : null,
                ranjang            : null
            })
        }
    },
    methods: {
        now() {
            return new Date;
        },
        submit(e) {
            this.form_kunjungan.post(e.target.action)
                .then(response => {
                    if (response.data.message && response.data.status) {
                        window.flash(response.data.message, response.data.status);
                    }

                    this.reset();
                })
                .catch(error => {
                    //
                });
        },
        reset() {
            this.form_kunjungan.rujukan = {
                jenis_id: null,
                asal    : null,
                nomor   : null,
                tanggal : null
            };
        }
    }
});
</script>
@endpush
