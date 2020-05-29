<data-table v-bind.sync="jenis_logistik" ref="table" v-model="selected_jenis">
    <div slot="form">
        <b-form-group v-bind="jenis_logistik.form.feedback('uraian')">
            <b slot="label">Uraian:</b>
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="jenis_logistik.form.uraian"
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
            jenis_logistik: {
                url   : `{{ action('Master\JenisLogistikController@index') }}`,
                sortBy: 'uraian',
                fields: [{
                    key      : 'uraian',
                    sortable : true,
                }],
                form: new Form({uraian: null}),
            }
        }
    },
});
</script>
@endpush
