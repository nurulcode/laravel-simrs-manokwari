<data-table v-bind.sync="oksigen" ref="table_oksigen" title="Oksigen" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <div class="row">
            <div class="col-md-8">
                <b-form-group v-bind="oksigen.form.feedback('oksigen_id')">
                    <b slot="label">Oksigen:</b>
                    <ajax-select
                        :params="{poliklinik: {{ $perawatan->poliklinik->id }}}"
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Oksigen"
                        select-label=""
                        url="{{ action('Master\OksigenController@index') }}"
                        v-model="oksigen.form.oksigen"
                        v-bind:key-value.sync="oksigen.form.oksigen_id"
                        v-on:select="oksigen.form.errors.clear('oksigen_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group v-bind="oksigen.form.feedback('jumlah')">
                    <b slot="label">Jumlah:</b>
                    <input
                        class="form-control"
                        v-model="oksigen.form.jumlah"
                        type="number"
                    >
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="oksigen.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="oksigen.form.petugas"
                v-bind:key-value.sync="oksigen.form.petugas_id"
                v-on:select="oksigen.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="oksigen.form.feedback('waktu')">
            <b slot="label">Waktu Pemberian Oksigen:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="oksigen.form.waktu"
                v-on:input="oksigen.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="oksigen" slot-scope="{value, item}" v-if="value">
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
            oksigen: {
                url   : `{{ action('Layanan\OksigenController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Pemeriksaan',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'oksigen',
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
                    oksigen_id    : null,
                    jumlah        : 1,
                    petugas_id    : null,
                    waktu         : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    petugas       : null,
                    oksigen       : null
                }),
            }
        }
    },
});
</script>
@endpush