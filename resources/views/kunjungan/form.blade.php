<?php
use App\Models\Master\Kasus;
use App\Models\Master\JenisRujukan;
use App\Models\Master\CaraPembayaran;
?>

<div class="row">
    <div class="col">
        <b-form-group v-bind="form_kunjungan.feedback('nomor_kunjungan')">
            <b slot="label">Nomor Kunjungan:</b>
            <input
                class="form-control"
                disabled
                name="nomor_kunjungan"
                placeholder="Nomor Kunjungan Akan Dibuat Secara Otomatis"
                type="text"
                v-model="form_kunjungan.nomor_kunjungan"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Waktu Kunjungan:" v-bind="form_kunjungan.feedback('waktu_masuk')">
            @if(isset($kunjungan))
                <input
                    class="form-control"
                    disabled
                    type="text"
                    v-model="form_kunjungan.waktu_masuk"
                    >
                </input>
            @else
                <date-picker
                    :default-date="now()"
                    :default-hour="now().getHours()"
                    alt-format="d/m/Y H:i"
                    enable-time
                    v-model="form_kunjungan.waktu_masuk"
                    v-on:input="form_kunjungan.errors.clear('waktu_masuk')"
                    >
                </date-picker>
            @endif
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Jenis Rujukan:" v-bind="form_kunjungan.feedback('rujukan.jenis_id')">
            <b-form-select v-model="form_kunjungan.rujukan.jenis_id">
                <option :value="null" disabled>Pilih Jenis Rujukan</option>
                @foreach(JenisRujukan::all() as $rujukan)
                    <option :value="{{ $rujukan->id }}">{{ $rujukan->uraian }}</option>
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col">
        <b-form-group label="Nomor Rujukan:" v-bind="form_kunjungan.feedback('rujukan.nomor')">
            <input
                class="form-control"
                name="rujukan.nomor"
                placeholder="Nomor Rujukan"
                type="text"
                v-model="form_kunjungan.rujukan.nomor"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Asal Rujukan:" v-bind="form_kunjungan.feedback('rujukan.asal')">
            <input
                class="form-control"
                name="rujukan.asal"
                placeholder="Asal Rujukan"
                type="text"
                v-model="form_kunjungan.rujukan.asal"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Tanggal Rujukan:" v-bind="form_kunjungan.feedback('rujukan.tanggal')">
            <date-picker
                alt-format="d/m/Y"
                v-model="form_kunjungan.rujukan.tanggal"
                v-on:input="form_kunjungan.errors.clear('rujukan.tanggal')"
                >
            </date-picker>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col">
        <b-form-group label="Cara Pembayaran:" v-bind="form_kunjungan.feedback('cara_pembayaran_id')">
            <b-form-select v-model="form_kunjungan.cara_pembayaran_id">
                <option :value="null" disabled>Pilih Cara Pembayaran</option>
                @foreach(CaraPembayaran::with('childs')->onlyFirstLevel()->get() as $pembayaran)
                    @if($pembayaran->childs->isEmpty())
                        <option :value="{{ $pembayaran->id }}">{{ $pembayaran->uraian }}</option>
                    @else
                        <optgroup label="{{ $pembayaran->uraian }}">
                            @foreach($pembayaran->childs as $child)
                                <option :value="{{ $child->id }}">{{ $child->uraian }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Nomor SJP:" v-bind="form_kunjungan.feedback('sjp_nomor')">
            <input
                class="form-control"
                name="sjp_nomor"
                placeholder="Nomor SJP"
                type="text"
                v-model="form_kunjungan.sjp_nomor"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Tanggal SJP:" v-bind="form_kunjungan.feedback('sjp_tanggal')">
            <date-picker
                alt-format="d/m/Y"
                v-model="form_kunjungan.sjp_tanggal"
                v-on:input="form_kunjungan.errors.clear('sjp_tanggal')"
                >
            </date-picker>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col">
        <b-form-group label="Penanggung Jawab:" v-bind="form_kunjungan.feedback('pj_nama')">
            <input
                class="form-control"
                maxlength="32"
                name="pj_nama"
                placeholder="Penanggung Jawab"
                type="text"
                v-model="form_kunjungan.pj_nama"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Telp. Penanggung Jawab:" v-bind="form_kunjungan.feedback('pj_telepon')">
            <input
                class="form-control"
                name="pj_telepon"
                placeholder="Telp. Penanggung Jawab"
                type="text"
                v-model="form_kunjungan.pj_telepon"
                >
            </input>
        </b-form-group>
    </div>
    <div class="col">
        <b-form-group label="Jenis Kasus:" v-bind="form_kunjungan.feedback('kasus_id')">
            <b-form-select v-model="form_kunjungan.kasus_id">
                <option :value="null" disabled>Pilih Jenis Kasus</option>
                @foreach(Kasus::orderBy('uraian', 'asc')->get() as $kasus)
                    <option :value="{{ $kasus->id }}">{{ $kasus->uraian }}</option>
                @endforeach
            </b-form-select>
        </b-form-group>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <b-form-group label="Diagnosa Awal:" v-bind="form_kunjungan.feedback('penyakit_id')">
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Diagnosa Awal"
                select-label=""
                url="{{ action('Master\Penyakit\PenyakitController@index') }}"
                v-model="form_kunjungan.penyakit"
                v-bind:key-value.sync="form_kunjungan.penyakit_id"
                v-on:select="form_kunjungan.errors.clear('penyakit_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.icd }} - @{{ option.uraian }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.icd }} - @{{ option.uraian }}</span>
                </template>
            </ajax-select>
        </b-form-group>
    </div>
</div>