<data-table v-bind.sync="logistik" ref="table">
    <div slot="form">
        <b-form-group v-bind="logistik.form.feedback('jenis_id')">
            <b slot="label">Jenis Logistik:</b>
            <b-form-select v-model="logistik.form.jenis_id">
                <option :value="null" disabled>Pilih Jenis Logistik</option>
                @foreach(App\Models\Master\JenisLogistik::all() as $logistik)
                    <option :value="{{ $logistik->id }}">{{ $logistik->uraian }}</option>
                @endforeach
            </b-form-select>
        </b-form-group>
        <b-form-group v-bind="logistik.form.feedback('uraian')">
            <b slot="label">Uraian:</b>
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="logistik.form.uraian"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="logistik.form.feedback('satuan')">
            <b slot="label">Satuan:</b>
            <input
                class="form-control"
                name="satuan"
                placeholder="Satuan"
                type="text"
                v-model="logistik.form.satuan"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="logistik.form.feedback('harga_jual')">
            <b slot="label">Harga Satuan:</b>
            <input
                class="form-control"
                name="harga_jual"
                placeholder="Harga Satuan"
                type="number"
                min="0"
                v-model="logistik.form.harga_jual"
                >
            </input>
        </b-form-group>
        <b-form-group label="Golongan:" v-bind="logistik.form.feedback('golongan')">
            <b-form-select
                :options="{{ json_encode(App\Enums\GolonganObat::toSelectOptions()) }}"
                v-on:change="logistik.errors.clear('golongan')"
                v-model="logistik.form.golongan">
                <template slot="first">
                    <option :value="null" disabled>Pilih Golongan</option>
                </template>
            </b-form-select>
        </b-form-group>
    </div>
    <template slot="jenis" slot-scope="{item, value}">
        @{{ value.uraian }}
    </template>
    <template slot="uraian" slot-scope="{item, value}">
        @{{ value }}
        <p class="text-muted" v-if="item.golongan"> @{{ golongan[item.golongan] }} </p>
    </template>
    <div slot="before-top-button" class="mr-3" style="width: 240px">
        <ajax-select
            :params="{jenis: 11}"
            deselect-label=""
            label="nama"
            url="{{ action('Fasilitas\PoliklinikController@index') }}"
            select-label=""
            placeholder="Total Stock"
            v-bind:key-value.sync="logistik.params.stock"
            v-model="logistik.poli"
            >
        </ajax-select>
    </div>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            golongan: @json(App\Enums\GolonganObat::toSelectArray()),
            logistik: {
                url   : `{{ action('Logistik\LogistikController@index') }}`,
                sortBy: 'jenis',
                params: {
                    jenis: null,
                    stock: '',
                },
                poli  : null,
                fields: [{
                    key      : 'jenis',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                },{
                    key      : 'satuan',
                },{
                    key      : 'harga_jual',
                    label    : 'Harga Satuan'
                },{
                    key      : 'stock'
                }],
                form: new Form({
                    uraian    : null,
                    jenis_id  : null,
                    satuan    : null,
                    harga_jual: 0,
                    golongan  : null
                }),
            }
        }
    },
});
</script>
@endpush
