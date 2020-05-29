<data-table v-bind.sync="transaksi" ref="table">
    <div slot="form">
        <b-form-group v-bind="transaksi.form.feedback('faktur_id')">
            <b slot="label">Faktur Penerimaan:</b>
            <ajax-select
                deselect-label=""
                label="no_faktur"
                placeholder="Pilih Nomor Faktur"
                select-label=""
                url="{{ action('Logistik\PenerimaanController@index') }}"
                v-model="transaksi.form.faktur"
                v-bind:key-value.sync="transaksi.form.faktur_id"
                v-on:select="transaksi.form.errors.clear('faktur_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.no_faktur }} - @{{ option.suplier.nama }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.no_faktur }} - @{{ option.suplier.nama }}</span>
                </template>
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="transaksi.form.feedback('logistik_id')">
            <b slot="label">Logistik:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Logistik"
                select-label=""
                url="{{ action('Logistik\LogistikController@index') }}"
                v-model="transaksi.form.logistik"
                v-bind:key-value.sync="transaksi.form.logistik_id"
                v-on:select="transaksi.form.errors.clear('logistik_id')"
                >
                <template slot="option" slot-scope="{option}">
                    <span>@{{ option.uraian }} - @{{ option.satuan }}</span>
                </template>
                <template slot="singleLabel" slot-scope="{option}">
                    <span>@{{ option.uraian }} - @{{ option.satuan }}</span>
                </template>
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="transaksi.form.feedback('apotek_id')">
            <b slot="label">Gudang/Apotek Tujuan:</b>
            <ajax-select
                :params="{jenis: 11}"
                deselect-label=""
                label="nama"
                placeholder="Pilih Gudang/Apotek Tujuan"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="transaksi.form.apotek"
                v-bind:key-value.sync="transaksi.form.apotek_id"
                v-on:select="transaksi.form.errors.clear('apotek_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="transaksi.form.feedback('harga')">
            <b slot="label">Harga Beli:</b>
            <input
                class="form-control"
                name="harga"
                placeholder="Harga Beli"
                type="number"
                v-model="transaksi.form.harga"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="transaksi.form.feedback('jumlah')">
            <b slot="label">Jumlah:</b>
            <input
                class="form-control"
                name="jumlah"
                placeholder="Jumlah"
                type="number"
                v-model="transaksi.form.jumlah"
                >
            </input>
        </b-form-group>
    </div>
    <template slot="faktur" slot-scope="{item, value}">
        @{{ value.no_faktur }}
        <p class="text-muted" v-if="value.suplier">@{{ value.suplier.nama }}</p>
    </template>
    <template slot="apotek" slot-scope="{item, value}">
        @{{ value.nama }}
    </template>
    <template slot="logistik" slot-scope="{item, value}">
        @{{ value.uraian }}
    </template>
    <template slot="jumlah" slot-scope="{item, value}">
        @{{ value }} @{{ item.logistik.satuan}}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            transaksi: {
                url   : `{{ action('Logistik\TransaksiController@index') }}`,
                params: {
                    faktur_type: @json(App\Models\Logistik\Penerimaan::class),
                    faktur_id  : null,
                },
                fields: [{
                    key      : 'faktur',
                    label    : 'Faktur'
                }, {
                    key      : 'apotek',
                }, {
                    key      : 'logistik',
                }, {
                    key      : 'jumlah',
                }, {
                    key      : 'harga',
                    label    : 'Harga Beli'
                }],
                form: new Form({
                    jenis      : @json(App\Enums\JenisTransaksi::PENERIMAAN),
                    faktur_type: @json(App\Models\Logistik\Penerimaan::class),
                    faktur_id  : null,
                    logistik_id: null,
                    apotek_id  : null,
                    harga      : 0,
                    jumlah     : 1
                }, {
                    logistik   : null,
                    apotek     : null,
                    faktur     : null
                }),
            }
        }
    },
});
</script>
@endpush
