<data-table v-bind.sync="tindakan" ref="table_tindakan" no-action no-add-button-text >
    <template slot="uraian" slot-scope="{item, value}">
        @{{ value }}
        <p>
            <span v-for="poliklinik in item.polikliniks" class="badge badge-primary mr-1">
                @{{ poliklinik.nama }}
            </span>
        </p>
    </template>
    <div slot="before-top-button" class="mr-3" style="width: 240px">
        <ajax-select
            deselect-label=""
            label="nama"
            url="{{ action('Fasilitas\PoliklinikController@index') }}"
            select-label=""
            placeholder="Filter by Poliklinik"
            v-bind:key-value.sync="tindakan.params.poliklinik"
            v-model="tindakan.poliklinik"
            >
        </ajax-select>
    </div>
    <template slot="action" slot-scope="{item}">
        <button
            class="btn btn-primary"
            v-on:click="setTarif(item.uraian, item.tarif, 'table_tindakan')">
            Ubah Tarif
        </button>
    </template>
</data-table>


@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            tindakan: {
                sortBy: `kode`,
                url   : `{{ action('Master\TindakanPemeriksaanController@index') }}`,
                params: {
                    poliklinik: null
                },
                fields: [{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                },{
                    key      : 'action',
                    label    : 'Ubah Tarif',
                    class    : 'text-center'
                }],
            }
        }
    },
});
</script>
@endpush
