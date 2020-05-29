<data-table v-bind.sync="resep" ref="table_resep" title="Resep" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <b-form-group v-bind="resep.form.feedback('obat_id')">
            <b slot="label">Obat/Alkes:</b>
            <ajax-select
                label="uraian"
                placeholder="Pilih Obat/Alkes"
                select-label=""
                url="{{ action('Logistik\LogistikController@index') }}"
                v-model="resep.form.obat"
                v-bind:key-value.sync="resep.form.obat_id"
                v-on:select="resep.form.errors.clear('obat_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="resep.form.feedback('jumlah')">
            <b slot="label">Jumlah:</b>
            <div class="input-group">
                <input
                    class="form-control"
                    name="jumlah"
                    placeholder="Jumlah"
                    type="text"
                    v-model="resep.form.jumlah"
                    >
                </input>
                <div class="input-group-append">
                    <span class="input-group-text" v-if="resep.form.obat">
                        @{{ resep.form.obat.satuan }}
                    </span>
                </div>
            </div>

        </b-form-group>
        <b-form-group v-bind="resep.form.feedback('aturan_pakai')">
            <b slot="label">Aturan Pakai:</b>
            <input
                class="form-control"
                name="aturan_pakai"
                placeholder="Aturan Pakai"
                type="text"
                v-model="resep.form.aturan_pakai"
                >
            </input>

        </b-form-group>
        <b-form-group v-bind="resep.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="resep.form.petugas"
                v-bind:key-value.sync="resep.form.petugas_id"
                v-on:select="resep.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="resep.form.feedback('waktu')">
            <b slot="label">Waktu Pemeriksaan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="resep.form.waktu"
                v-on:input="resep.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="obat" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
    </template>
    <template slot="jumlah" slot-scope="{value, item}">
        @{{ value }} <span class="text-muted">@{{ item.obat.satuan }}</span>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            resep: {
                url   : `{{ action('Layanan\ResepDetailController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'obat',
                },{
                    key      : 'jumlah'
                }, {
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan)),
                    obat_id       : null,
                    jumlah        : null,
                    aturan_pakai  : null,
                    petugas_id    : null,
                    waktu         : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    obat          : null,
                    petugas       : null
                }),
            }
        }
    },
});
</script>
@endpush