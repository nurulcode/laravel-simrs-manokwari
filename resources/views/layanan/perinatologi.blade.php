<data-table v-bind.sync="perinatologi" ref="table_perinatologi" title="Tindakan" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <div class="row">
            <div class="col-md-8">
                <b-form-group v-bind="perinatologi.form.feedback('kegiatan_id')">
                    <b slot="label">Kegiatan:</b>
                    <ajax-select
                        :params="{kategori: 6}"
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Kegiatan"
                        select-label=""
                        url="{{ action('Master\KegiatanController@index') }}"
                        v-model="perinatologi.form.kegiatan"
                        v-bind:key-value.sync="perinatologi.form.kegiatan_id"
                        v-on:select="perinatologi.form.errors.clear('kegiatan_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group v-bind="perinatologi.form.feedback('jumlah')">
                    <b slot="label">Jumlah:</b>
                    <input
                        class="form-control"
                        v-model="perinatologi.form.jumlah"
                        type="number"
                    >
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="perinatologi.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="perinatologi.form.petugas"
                v-bind:key-value.sync="perinatologi.form.petugas_id"
                v-on:select="perinatologi.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="perinatologi.form.feedback('waktu')">
            <b slot="label">Waktu Tindakan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="perinatologi.form.waktu"
                v-on:input="perinatologi.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="kegiatan" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
        <p class="text-muted">
            Jumlah: @{{ item.jumlah }} x
        </p>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            perinatologi: {
                url   : `{{ action('Layanan\PerinatologiController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Pemeriksaan',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'kegiatan',
                },{
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    perawatan_id           : @json($perawatan->id),
                    perawatan_type         : @json(get_class($perawatan)),
                    kegiatan_id: null,
                    jumlah                 : 1,
                    petugas_id             : null,
                    waktu                  : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    petugas                : null,
                    kegiatan   : null
                }),
            }
        }
    },
});
</script>
@endpush