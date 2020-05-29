<data-table v-bind.sync="jabatan" ref="table" v-model="selected_jabatan"
    @cannot('create', App\Models\Kepegawaian\Jabatan::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group v-bind="jabatan.form.feedback('uraian')">
            <b slot="label">Uraian:</b>
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="jabatan.form.uraian"
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
            jabatan: {
                url   : `{{ action('Kepegawaian\JabatanController@index') }}`,
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
