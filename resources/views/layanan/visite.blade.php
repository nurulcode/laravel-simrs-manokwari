<data-table v-bind.sync="visite" ref="table_visite" title="Visite"
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
>
    <div slot="form">
        <b-form-group v-bind="visite.form.feedback('jenis_visite_id')">
            <b slot="label">Jenis Visite:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Jenis Visite"
                select-label=""
                url="{{ action('Master\JenisVisiteController@index') }}"
                v-model="visite.form.visite"
                v-bind:key-value.sync="visite.form.jenis_visite_id"
                v-on:select="visite.form.errors.clear('jenis_visite_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="visite.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="visite.form.petugas"
                v-bind:key-value.sync="visite.form.petugas_id"
                v-on:select="visite.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="visite.form.feedback('waktu')">
            <b slot="label">Waktu Visite:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="visite.form.waktu"
                v-on:input="visite.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
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
            visite: {
                url   : `{{ action('Layanan\VisiteController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Visite',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'jenis_visite',
                    formatter: visite => visite ? visite.uraian : ''
                },{
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                },{
                    key      : 'tarif_sarana',
                },{
                    key      : 'tarif_pelayanan',
                },{
                    key      : 'tarif_bhp',
                    label    : 'Tarif BHP'
                }],
                form: new Form({
                    perawatan_id    : @json($perawatan->id),
                    perawatan_type  : @json(get_class($perawatan)),
                    jenis_visite_id: null,
                    petugas_id     : null,
                    waktu          : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    jenis_visite   : null,
                    petugas        : null
                }),
            }
        }
    },
});
</script>
@endpush