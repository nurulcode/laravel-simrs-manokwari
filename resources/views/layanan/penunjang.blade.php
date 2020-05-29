<data-table v-bind.sync="penunjang" ref="table_penunjang" title="Rujuk Ke Fasilitas Penunjang" no-action
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
    >
    <div slot="form">
        <b-form-group v-bind="penunjang.form.feedback('jenis')">
            <b slot="label">Jenis:</b>
            <b-form-select
                :options="{{ json_encode(App\Enums\TypePenunjang::toSelectOptions()) }}"
                v-model="penunjang.form.jenis">
                <template slot="first">
                    <option :value="null" disabled>Pilih Jenis Penunjang</option>
                </template>
            </b-form-select>
        </b-form-group>
        <b-form-group v-bind="penunjang.form.feedback('poliklinik_id')">
            <b slot="label">Fasilitas Tujuan:</b>
            <ajax-select
                :params="{jenis: penunjang.form.jenis}"
                deselect-label=""
                :disabled="!penunjang.form.jenis"
                label="nama"
                placeholder="Pilih Fasilitas Tujuan"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="penunjang.form.poliklinik"
                v-bind:key-value.sync="penunjang.form.poliklinik_id"
                v-on:select="penunjang.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="penunjang.form.feedback('waktu')">
            <b slot="label">Waktu Rujukan:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="penunjang.form.waktu"
                v-on:input="penunjang.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
        <b-form-group label="Catatan:" v-bind="penunjang.form.feedback('waktu')">
            <textarea
                class="form-control"
                name="catatan"
                v-model="penunjang.form.catatan">

            </textarea>
        </b-form-group>
    </div>
    <template slot="view" slot-scope="{item}">
        <a :href="item.path" class="btn btn-primary"> <i class="icon-eye"></i> </a>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            penunjang: {
                url   : `{{ action('Layanan\PenunjangController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'poliklinik',
                    label    : 'Fasilitas Tujuan',
                    formatter: poliklinik => poliklinik ? poliklinik.nama : ''
                },{
                    key      : 'catatan',
                },{
                    key      : 'view',
                    label    : 'Lihat',
                    class    : 'text-center'
                }],
                form: new Form({
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan)),
                    poliklinik_id : null,
                    catatan       : null,
                    waktu         : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    poliklinik    : null,
                    jenis         : null
                }),
                addButtonText: 'Rujuk ke Fasilitas Penunjang'
            }
        }
    },
});
</script>
@endpush