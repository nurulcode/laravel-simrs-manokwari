@extends('layouts.tabs')

@section('title', 'Penerimaan Management')

@section('tabs')

<b-tab title="Penerimaan">
    <data-table v-bind.sync="penerimaan" ref="table" v-model="selected_penerimaan">
        <div slot="form">
            <b-form-group v-bind="penerimaan.form.feedback('suplier_id')">
                <b slot="label">Suplier:</b>
                <ajax-select
                    deselect-label=""
                    label="nama"
                    placeholder="Pilih Suplier"
                    select-label=""
                    url="{{ action('Logistik\SuplierController@index') }}"
                    v-model="penerimaan.form.suplier"
                    v-bind:key-value.sync="penerimaan.form.suplier_id"
                    v-on:select="penerimaan.form.errors.clear('suplier_id')"
                    >

                </ajax-select>
            </b-form-group>
            <b-form-group v-bind="penerimaan.form.feedback('no_faktur')">
                <b slot="label">Nomor Faktur:</b>
                <input
                    class="form-control"
                    name="no_faktur"
                    placeholder="Nomor Faktur"
                    type="text"
                    v-model="penerimaan.form.no_faktur"
                    >
                </input>
            </b-form-group>
            <b-form-group v-bind="penerimaan.form.feedback('tanggal_faktur')">
                <b slot="label">Tanggal Faktur:</b>
                <date-picker
                    alt-format="d/m/Y"
                    v-model="penerimaan.form.tanggal_faktur"
                    v-on:input="penerimaan.form.errors.clear('tanggal_faktur')"
                    >
                </date-picker>
            </b-form-group>
            <b-form-group v-bind="penerimaan.form.feedback('tanggal_terima')">
                <b slot="label">Tanggal Terima:</b>
                <date-picker
                    alt-format="d/m/Y"
                    v-model="penerimaan.form.tanggal_terima"
                    v-on:input="penerimaan.form.errors.clear('tanggal_terima')"
                    >
                </date-picker>
            </b-form-group>
            <b-form-group v-bind="penerimaan.form.feedback('sistem_pembayaran')">
                <b slot="label">Sistem Pembayaran:</b>
                <b-form-select
                    :options="{{ json_encode(App\Enums\SistemPembayaran::toSelectOptions()) }}"
                    v-model="penerimaan.form.sistem_pembayaran">
                </b-form-select>
            </b-form-group>
            <b-form-group v-bind="penerimaan.form.feedback('jatuh_tempo')">
                <b slot="label">Tanggal Jatuh Tempo:</b>
                <date-picker
                    alt-format="d/m/Y"
                    v-model="penerimaan.form.jatuh_tempo"
                    v-on:input="penerimaan.form.errors.clear('jatuh_tempo')"
                    >
                </date-picker>
            </b-form-group>
        </div>
    </data-table>
</b-tab>
<b-tab title="Transaksi Penerimaan">
    <closable-card v-if="!!selected_penerimaan" header="Penerimaan Terpilih:"
        v-on:close="selected_penerimaan = null">
        <h5>@{{ selected_penerimaan.no_faktur }} - @{{ selected_penerimaan.suplier.nama }}</h5>
        <p class="text-muted">@{{ selected_penerimaan.tanggal_terima }}</p>
    </closable-card>
    @include('logistik.penerimaan_transaksi')
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            selected_penerimaan  : null,
            penerimaan: {
                url   : `{{ action('Logistik\PenerimaanController@index') }}`,
                sortBy: 'tanggal_faktur',
                fields: [{
                    key      : 'tanggal_terima',
                    sortable : true,
                },{
                    key      : 'suplier',
                    formatter: suplier => suplier ? suplier.nama: ''
                },{
                    key      : 'no_faktur',
                },{
                    key      : 'tanggal_faktur',
                    sortable : true,
                }],
                form: new Form({
                    suplier_id       : null,
                    no_faktur        : null,
                    tanggal_faktur   : null,
                    jatuh_tempo      : null,
                    tanggal_terima   : null,
                    sistem_pembayaran: 1
                }, {
                    suplier          : null
                }),
            }
        }
    },
    watch: {
        selected_penerimaan(value) {
            this.transaksi.params.faktur_id = value && value.id;

            this.transaksi.form.setDefault('faktur', value);

            this.transaksi.form.setDefault('faktur_id', value && value.id);

            this.selected_tab = value ? 1 : this.selected_tab;
        },
    }
});
</script>
@endpush
