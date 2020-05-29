<data-table v-bind.sync="diagnosa" ref="table_diagnosa" title="Diagnosa"
    @if ($perawatan->waktu_keluar)
        no-action
        no-add-button-text
    @endif
>
    <div slot="form">
        <b-form-group v-bind="diagnosa.form.feedback('penyakit_id')">
            <b slot="label">Penyakit:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Penyakit"
                select-label=""
                url="{{ action('Master\Penyakit\PenyakitController@index') }}"
                v-model="diagnosa.form.penyakit"
                v-bind:key-value.sync="diagnosa.form.penyakit_id"
                v-on:select="diagnosa.form.errors.clear('penyakit_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.icd }} - @{{ option.uraian }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.icd }} - @{{ option.uraian }}</span>
                </template>
            </ajax-select>
        </b-form-group>
        <b-form-group label="Lama Menderita:" v-bind="diagnosa.form.feedback('lama_menderita')">
            <input
                class="form-control"
                name="lama_menderita"
                placeholder="Lama Menderita"
                type="text"
                v-model="diagnosa.form.lama_menderita"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group v-bind="diagnosa.form.feedback('kasus')">
                    <b slot="label">Kasus:</b>
                    <b-form-select v-model="diagnosa.form.kasus"
                        :options="{{ json_encode(App\Enums\KasusDiagnosa::toSelectOptions()) }}"
                        v-on:change="diagnosa.form.errors.clear('kasus')"
                        v-model="diagnosa.form.kasus">
                        <template slot="first">
                            <option :value="null" disabled>Pilih Kasus</option>
                        </template>
                    </b-form-select>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group v-bind="diagnosa.form.feedback('tipe_diagnosa_id')">
                    <b slot="label">Tipe:</b>
                    <b-form-select
                        v-on:change="diagnosa.form.errors.clear('tipe_diagnosa_id')"
                        v-model="diagnosa.form.tipe_diagnosa_id">
                        <option :value="null" disabled>Pilih Tipe</option>
                        @foreach(App\Models\Master\TipeDiagnosa::all() as $tipe)
                            <option :value="{{ $tipe->id }}">{{ $tipe->uraian }}</option>
                        @endforeach
                    </b-form-select>
                </b-form-group>
            </div>
        </div>
        <b-form-group v-bind="diagnosa.form.feedback('petugas_id')">
            <b slot="label">Petugas:</b>
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Petugas"
                select-label=""
                url="{{ action('Kepegawaian\PegawaiController@index') }}"
                v-model="diagnosa.form.petugas"
                v-bind:key-value.sync="diagnosa.form.petugas_id"
                v-on:select="diagnosa.form.errors.clear('petugas_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="diagnosa.form.feedback('waktu')">
            <b slot="label">Waktu Diagnosa:</b>
            <date-picker
                alt-format="d/m/Y H:i"
                enable-time
                v-model="diagnosa.form.waktu"
                v-on:input="diagnosa.form.errors.clear('waktu')"
                >
            </date-picker>
        </b-form-group>
    </div>
    <template slot="penyakit" slot-scope="{value, item}" v-if="value">
        @{{ value.icd }} - @{{ value.uraian }}
        <p class="text-muted"> @{{ item.tipe.uraian }} </p>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            diagnosa: {
                url   : `{{ action('Layanan\DiagnosaController@index') }}`,
                params: {
                    perawatan_id  : @json($perawatan->id),
                    perawatan_type: @json(get_class($perawatan))
                },
                fields: [{
                    key      : 'waktu',
                    label    : 'Waktu Diagnosa',
                    formatter: waktu => waktu ? window.date_time(waktu) : ''
                },{
                    key      : 'penyakit',
                },{
                    key      : 'lama_menderita'
                }, {
                    key      : 'petugas',
                    formatter: petugas => petugas && petugas.nama
                }],
                form: new Form({
                    perawatan_id    : @json($perawatan->id),
                    perawatan_type  : @json(get_class($perawatan)),
                    penyakit_id     : null,
                    lama_menderita  : null,
                    kasus           : null,
                    tipe_diagnosa_id: null,
                    petugas_id      : null,
                    waktu           : format(new Date(), 'YYYY-MM-DD HH:mm:ss')
                }, {
                    penyakit        : null,
                    petugas         : null
                }),
            }
        }
    },
});
</script>
@endpush