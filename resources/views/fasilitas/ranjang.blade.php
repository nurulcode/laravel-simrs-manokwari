<closable-card v-if="!!selected_kamar" header="Kamar Terpilih:" v-on:close="selected_kamar = null">
    <h5>@{{ selected_kamar.ruangan.nama }}, @{{ selected_kamar.nama }}</h5>
</closable-card>

<data-table v-bind.sync="ranjang" ref="table">
    <div slot="form">
        <b-form-group label="Poliklinik:" v-bind="ranjang.form.feedback('poliklinik_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Poliklinik"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="ranjang.form.poliklinik"
                v-bind:key-value.sync="ranjang.form.poliklinik_id"
                v-on:select="ranjang.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Ruangan:" v-bind="ranjang.form.feedback('ruangan_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Ruangan"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="ranjang.form.ruangan"
                v-bind:key-value.sync="ranjang.form.ruangan_id"
                v-on:select="ranjang.form.errors.clear('ruangan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Kode Ranjang:" v-bind="ranjang.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode Ranjang"
                type="text"
                v-model="ranjang.form.kode"
                >
            </input>
        </b-form-group>
    </div>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            ranjang: {
                sortBy: `poliklinik`,
                url   : `{{ action('Fasilitas\RanjangController@index') }}`,
                params: {
                    kamar: null
                },
                fields: [{
                    key       : 'poliklinik',
                    sortable  : true,
                    formatter : poliklinik => poliklinik && poliklinik.nama
                },{
                    key       : 'ruangan',
                    sortable  : true,
                    formatter : ruangan => ruangan && ruangan.nama
                },{
                    key       : 'kamar',
                    sortable  : true,
                    formatter : kamar => kamar && kamar.nama
                },{
                    key       : 'kode',
                    label     : 'Ranjang',
                    sortable  : true,
                }],
                form: new Form({
                    poliklinik_id: null,
                    kamar_id     : null,
                    ruangan_id   : null,
                    kode         : null,
                }, {
                    poliklinik   : null,
                    kamar        : null,
                    ruangan      : null,
                }),
            }
        }
    },
});
</script>
@endpush