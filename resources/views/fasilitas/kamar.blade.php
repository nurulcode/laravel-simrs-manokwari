<closable-card v-if="!!selected_ruangan" header="Ruangan Terpilih:" v-on:close="selected_ruangan = null">
    <h5>@{{ selected_ruangan.poliklinik.nama }}, @{{ selected_ruangan.nama }}</h5>
</closable-card>

<data-table v-bind.sync="kamar" ref="table" v-model="selected_kamar">
    <div slot="form">
        <b-form-group label="Poliklinik:" v-bind="kamar.form.feedback('poliklinik_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Poliklinik"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="kamar.form.poliklinik"
                v-bind:key-value.sync="kamar.form.poliklinik_id"
                v-on:select="kamar.form.errors.clear('poliklinik_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Ruangan:" v-bind="kamar.form.feedback('ruangan_id')">
            <ajax-select
                deselect-label=""
                label="nama"
                placeholder="Pilih Ruangan"
                select-label=""
                url="{{ action('Fasilitas\PoliklinikController@index') }}"
                v-model="kamar.form.ruangan"
                v-bind:key-value.sync="kamar.form.ruangan_id"
                v-on:select="kamar.form.errors.clear('ruangan_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group label="Nama:" v-bind="kamar.form.feedback('nama')">
            <input
                class="form-control"
                name="nama"
                placeholder="Nama"
                type="text"
                v-model="kamar.form.nama"
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
            kamar: {
                sortBy: `poliklinik`,
                url   : `{{ action('Fasilitas\KamarController@index') }}`,
                params: {
                    ruangan: null
                },
                fields: [{
                    key       : 'poliklinik',
                    sortable  : true,
                    formatter : poliklinik => poliklinik && poliklinik.nama,
                },{
                    key       : 'ruangan',
                    sortable  : true,
                    formatter : ruangan => ruangan && ruangan.nama,
                },{
                    key       : 'nama',
                    sortable  : true,
                }],
                form: new Form({
                    poliklinik_id: null,
                    ruangan_id   : null,
                    nama         : null,
                }, {
                    poliklinik   : null,
                    ruangan      : null,
                }),
            }
        }
    },
});
</script>
@endpush