<data-table v-bind.sync="transaksi" ref="table" no-edit>
    <div slot="form">
        <b-form-group v-bind="transaksi.form.feedback('logistik_id')">
            <b slot="label">Obat/Alkes:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Obat/Alkes"
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
            <b slot="label">Gudang/Apotek Asal:</b>
            <ajax-select
                :params="{jenis: 11}"
                deselect-label=""
                label="nama"
                placeholder="Pilih Gudang/Apotek Asal"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="transaksi.form.apotek"
                v-bind:key-value.sync="transaksi.form.apotek_id"
                v-on:select="transaksi.form.errors.clear('apotek_id')"
                >
            </ajax-select>
        </b-form-group>

        <b-form-group v-bind="transaksi.form.feedback('jumlah')">
            <b slot="label">Jumlah:</b>
            <input
                class="form-control"
                name="jumlah"
                placeholder="Jumlah"
                type="number"
                v-model="jumlahObat"
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
        @{{ Math.abs(value) }} @{{ item.logistik.satuan}}
    </template>
    <template slot="harga_total" slot-scope="{item, value}">
        @{{ Math.abs(item.harga * item.jumlah) }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    computed: {
        jumlahObat: {
            get() {
                return Math.abs(this.transaksi.form.jumlah);
            },

            set(value) {
                this.transaksi.form.jumlah = 0 - value;
            }
        }
    },
    data() {
        return {
            transaksi: {
                url   : `{{ action('Logistik\TransaksiController@index') }}`,
                params: {
                    faktur_type: @json(App\Models\Layanan\Resep::class),
                    faktur_id  : `{{ $resep->id }}`,
                },
                fields: [{
                    key      : 'logistik',
                    label    : 'Obat/Alkes'
                },{
                    key      : 'apotek',
                }, {
                    key      : 'jumlah',
                }, {
                    key      : 'harga',
                    label    : 'Harga Satuan'
                }, {
                    key      : 'harga_total',
                }],
                form: new Form({
                    jenis      : @json(App\Enums\JenisTransaksi::PENGELUARAN),
                    faktur_type: @json(App\Models\Layanan\Resep::class),
                    faktur_id  : `{{ $resep->id }}`,
                    logistik_id: null,
                    apotek_id  : null,
                    harga      : 0,
                    jumlah     : 0
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
