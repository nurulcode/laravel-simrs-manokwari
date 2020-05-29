<data-table v-bind.sync="gizi" ref="table_gizi" title="Gizi" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <div class="row">
            <div class="col-md-8">
                <b-form-group v-bind="gizi.form.feedback('gizi_id')">
                    <b slot="label">Gizi:</b>
                    <ajax-select
                        :params="{poliklinik: {{ $perawatan->poliklinik->id }}}"
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Gizi"
                        select-label=""
                        url="{{ action('Master\GiziController@index') }}"
                        v-model="gizi.form.gizi"
                        v-bind:key-value.sync="gizi.form.gizi_id"
                        v-on:select="gizi.form.errors.clear('gizi_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group v-bind="gizi.form.feedback('jumlah')">
                    <b slot="label">Jumlah:</b>
                    <input
                        class="form-control"
                        v-model="gizi.form.jumlah"
                        type="number"
                    >
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="gizi.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="gizi.form.petugas"
                v-bind:key-value.sync="gizi.form.petugas_id"
                v-on:select="gizi.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="gizi.form.feedback('waktu')">
            <b slot="label">Waktu:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="gizi.form.waktu"
                v-on:input="gizi.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="gizi" slot-scope="{value, item}" v-if="value">
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
            gizi: {
                url   : `{{ action('Layanan\GiziController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Pemeriksaan',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'gizi',
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
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan)),
                    gizi_id       : null,
                    jumlah        : 1,
                    petugas_id    : null,
                    waktu         : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    petugas       : null,
                    gizi          : null
                }),
            }
        }
    },
});
</script>
@endpush