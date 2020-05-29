<data-table v-bind.sync="tindakan" ref="table_tindakan" title="Tindakan" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <div class="row">
            <div class="col-md-8">
                <b-form-group v-bind="tindakan.form.feedback('tindakan_pemeriksaan_id')">
                    <b slot="label">Tindakan/Pemeriksaan:</b>
                    <ajax-select
                        :params="{poliklinik: {{ $perawatan->poliklinik->id }}}"
                        deselect-label=""
                        label="kode"
                        placeholder="Pilih Tindakan/Pemeriksaan"
                        select-label=""
                        url="{{ action('Master\TindakanPemeriksaanController@index') }}"
                        v-model="tindakan.form.tindakan_pemeriksaan"
                        v-bind:key-value.sync="tindakan.form.tindakan_pemeriksaan_id"
                        v-on:select="tindakan.form.errors.clear('tindakan_pemeriksaan_id')"
                        >
                        <template slot="option" slot-scope="{option}">
                            <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                        </template>
                        <template slot="singleLabel" slot-scope="{option}">
                            <span>@{{ option.kode }} - @{{ option.uraian }}</span>
                        </template>
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group v-bind="tindakan.form.feedback('jumlah')">
                    <b slot="label">Jumlah:</b>
                    <input
                        class="form-control"
                        v-model="tindakan.form.jumlah"
                        type="number"
                    >
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="tindakan.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="tindakan.form.petugas"
                v-bind:key-value.sync="tindakan.form.petugas_id"
                v-on:select="tindakan.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="tindakan.form.feedback('waktu')">
            <b slot="label">Waktu Tindakan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="tindakan.form.waktu"
                v-on:input="tindakan.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="tindakan_pemeriksaan" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
        <p class="text-muted">
            Jumlah: @{{ item.jumlah }} x
        </p>
    </template>
    <template slot="tarif_sarana" slot-scope="{item}">
        @{{ item.tarif && item.tarif.SARANA }}
    </template>
    <template slot="tarif_pelayanan" slot-scope="{item}">
        @{{ item.tarif && item.tarif.PELAYANAN }}
    </template>
    <template slot="tarif_bhp" slot-scope="{item}">
        @{{ item.tarif && item.tarif.BHP }}
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            tindakan: {
                url   : `{{ action('Layanan\TindakanController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Pemeriksaan',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'tindakan_pemeriksaan',
                },{
                    key      : 'tarif_sarana',
                },{
                    key      : 'tarif_pelayanan',
                },{
                    key      : 'tarif_bhp',
                    label    : 'Tarif BHP'
                },{
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    perawatan_id           : @json($perawatan->id),
                    perawatan_type         : @json(get_class($perawatan)),
                    tindakan_pemeriksaan_id: null,
                    jumlah                 : 1,
                    petugas_id             : null,
                    waktu                  : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    petugas                : null,
                    tindakan_pemeriksaan   : null
                }),
            }
        }
    },
});
</script>
@endpush