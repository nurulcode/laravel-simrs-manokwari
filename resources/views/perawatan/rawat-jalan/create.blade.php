@extends('kunjungan.create')

@section('title', 'Registrasi Pasien Rawat Jalan')

@section('action', action('Perawatan\RawatJalanController@store'))

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
                cara_pembayaran_id : null,
                sjp_nomor          : null,
                sjp_tanggal        : null,
                pj_nama            : null,
                pj_telepon         : null,
                kasus_id           : null,
                penyakit_id        : null,
                jenis_registrasi_id: null,
                poliklinik_id      : null,
                kegiatan_id        : null
            },{
                pasien             : null,
                jenis_rujukan      : null,
                kasus              : null,
                penyakit           : null,
                jenis_registrasi   : null,
                poliklinik         : null,
                kegiatan           : null
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
