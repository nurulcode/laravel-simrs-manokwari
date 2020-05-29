<data-table v-bind.sync="laundry" ref="table_laundry" title="Laundry" no-edit
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <div class="row">
            <div class="col-md-8">
                <b-form-group v-bind="laundry.form.feedback('jenis_laundry_id')">
                    <b slot="label">Jenis Laundry:</b>
                    <ajax-select
                        deselect-label=""
                        label="uraian"
                        placeholder="Pilih Jenis Laundry"
                        select-label=""
                        url="{{ action('Master\JenisLaundryController@index') }}"
                        v-model="laundry.form.jenis_laundry"
                        v-bind:key-value.sync="laundry.form.jenis_laundry_id"
                        v-on:select="laundry.form.errors.clear('jenis_laundry_id')"
                        >
                    </ajax-select>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group v-bind="laundry.form.feedback('jumlah')">
                    <b slot="label">Jumlah:</b>
                    <input
                        class="form-control"
                        v-model="laundry.form.jumlah"
                        type="number"
                    >
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="laundry.form.feedback('waktu')">
            <b slot="label">Waktu Laundry:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="laundry.form.waktu"
                v-on:input="laundry.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="jenis_laundry" slot-scope="{value, item}" v-if="value">
        @{{ value.uraian }}
        <p class="text-muted">
            Jumlah: @{{ item.jumlah }} @{{ value.satuan }}
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
            laundry: {
                url   : `{{ action('Layanan\LaundryController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'jenis_laundry',
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
                    jenis_laundry_id: null,
                    jumlah          : 1,
                    waktu           : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    jenis_laundry   : null
                }),
            }
        }
    },
});
</script>
@endpush