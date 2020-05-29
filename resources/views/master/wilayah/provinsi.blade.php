<data-table v-bind.sync="provinsi" ref="table" v-model="selected_provinsi"
    @cannot('create', App\Models\Master\Wilayah\Provinsi::class)
        no-add-button-text
    @endcannot
    >
    <div slot="form">
        <b-form-group v-bind="provinsi.form.feedback('name')">
            <b slot="label">Name:</b>
            <input
                class="form-control"
                name="name"
                placeholder="Name"
                type="text"
                v-model="provinsi.form.name"
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
            provinsi: {
                sortBy: `name`,
                url   : `{{ action('Master\Wilayah\ProvinsiController@index') }}`,
                fields: [{
                    key     : 'name',
                    sortable: true,
                }],
                form: new Form({ name: null }),
            }
        }
    },
});
</script>
@endpush