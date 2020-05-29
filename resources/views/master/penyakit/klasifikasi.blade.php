<data-table v-bind.sync="klasifikasi" ref="table" v-model="selected_klasifikasi">
    <div slot="form">
        <b-form-group label="Kode:" v-bind="klasifikasi.form.feedback('kode')">
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="klasifikasi.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group label="Uraian:" v-bind="klasifikasi.form.feedback('uraian')">
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="klasifikasi.form.uraian"
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
            klasifikasi: {
                sortBy: `kode`,
                url   : `{{ action('Master\Penyakit\KlasifikasiPenyakitController@index') }}`,
                fields: [{
                    key     : 'kode',
                    sortable: true,
                },{
                    key     : 'uraian',
                    sortable: true,
                }],
                form: new Form({
                    kode  : null,
                    uraian: null
                }),
            },
        }
    }
});
</script>
@endpush