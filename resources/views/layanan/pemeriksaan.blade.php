<data-table v-bind.sync="pemeriksaan" ref="table_pemeriksaan" title="Pemeriksaan" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <b-form-group v-bind="pemeriksaan.form.feedback('pemeriksaan_umum_id')">
            <b slot="label">Jenis Pemeriksaan:</b>
            <ajax-select
                :params="{grouped:true}"
                deselect-label=""
                group-values="childs"
                group-label="uraian"
                label="uraian"
                placeholder="Pilih Jenis Pemeriksaan"
                select-label=""
                url="{{ action('Master\PemeriksaanUmumController@index') }}"
                v-model="pemeriksaan.form.pemeriksaan_umum"
                v-bind:key-value.sync="pemeriksaan.form.pemeriksaan_umum_id"
                v-on:select="pemeriksaan.form.errors.clear('pemeriksaan_umum_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="pemeriksaan.form.feedback('hasil')">
            <b slot="label">Hasil Pemeriksaan:</b>
            <div class="input-group">
                <input
                    class="form-control"
                    name="hasil"
                    placeholder="Hasil Pemeriksaan"
                    type="text"
                    v-model="pemeriksaan.form.hasil"
                    >
                </input>
                <div class="input-group-append">
                    <span class="input-group-text" v-if="pemeriksaan.form.pemeriksaan_umum">
                        @{{ pemeriksaan.form.pemeriksaan_umum.satuan }}
                    </span>
                </div>
            </div>

        </b-form-group>
        <b-form-group v-bind="pemeriksaan.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="pemeriksaan.form.petugas"
                v-bind:key-value.sync="pemeriksaan.form.petugas_id"
                v-on:select="pemeriksaan.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="pemeriksaan.form.feedback('waktu')">
            <b slot="label">Waktu Pemeriksaan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="pemeriksaan.form.waktu"
                v-on:input="pemeriksaan.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="pemeriksaan_umum" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
    </template>
    <template slot="hasil" slot-scope="{value, item}">
        @{{ value }} <span class="text-muted">@{{ item.pemeriksaan_umum.satuan }}</span>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            pemeriksaan: {
                url   : `{{ action('Layanan\PemeriksaanController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Diagnosa',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'pemeriksaan_umum',
                },{
                    key      : 'hasil'
                }, {
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    perawatan_id    : @json($perawatan->id),
                    perawatan_type  : @json(get_class($perawatan)),
                    pemeriksaan_umum_id: null,
                    hasil              : null,
                    petugas_id         : null,
                    waktu              : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    pemeriksaan_umum   : null,
                    petugas            : null
                }),
            }
        }
    },
});
</script>
@endpush