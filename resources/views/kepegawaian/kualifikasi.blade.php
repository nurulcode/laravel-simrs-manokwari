<closable-card v-if="!!selected_kategori" header="Kategori Terpilih:"
    v-on:close="selected_kategori = null">
    <h5>@{{ selected_kategori.uraian }}</h5>
</closable-card>

<data-table v-bind.sync="kualifikasi" ref="table" v-model="selected_kualifikasi">
    <div slot="form">
        <b-form-group v-bind="kualifikasi.form.feedback('kategori_id')">
            <b slot="label">Kualifikasi:</b>
            <ajax-select
                deselect-label=""
                label="uraian"
                placeholder="Pilih Kualifikasi"
                select-label=""
                url="{{ action('Kepegawaian\KategoriKualifikasiController@index') }}"
                v-model="kualifikasi.form.kategori"
                v-bind:key-value.sync="kualifikasi.form.kategori_id"
                v-on:select="kualifikasi.form.errors.clear('kategori_id')"
                >
            </ajax-select>
        </b-form-group>
        <b-form-group v-bind="kualifikasi.form.feedback('kode')">
            <b slot="label">Kode:</b>
            <input
                class="form-control"
                name="kode"
                placeholder="Kode"
                type="text"
                v-model="kualifikasi.form.kode"
                >
            </input>
        </b-form-group>
        <b-form-group v-bind="kualifikasi.form.feedback('uraian')">
            <b slot="label">Uraian:</b>
            <input
                class="form-control"
                name="uraian"
                placeholder="Uraian"
                type="text"
                v-model="kualifikasi.form.uraian"
                >
            </input>
        </b-form-group>
        <div class="row">
            <div class="col">
                <b-form-group v-bind="kualifikasi.form.feedback('laki_laki')">
                    <b slot="label">Kebutuhan Laki-laki:</b>
                    <input
                        class="form-control"
                        name="laki_laki"
                        placeholder="Kebutuhan Laki-laki"
                        type="number"
                        v-model="kualifikasi.form.laki_laki"
                        >
                    </input>
                </b-form-group>
            </div>
            <div class="col">
                <b-form-group v-bind="kualifikasi.form.feedback('perempuan')">
                    <b slot="label">Kebutuhan Perempuan:</b>
                    <input
                        class="form-control"
                        name="perempuan"
                        placeholder="Kebutuhan Perempuan"
                        type="number"
                        v-model="kualifikasi.form.perempuan"
                        >
                    </input>
                </b-form-group>
            </div>
        </div>
    </div>
    <template slot="kategori" slot-scope="{value}">
        @{{ value.uraian.toUpperCase() }}
    </template>
</data-table>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kualifikasi: {
                url   : `{{ action('Kepegawaian\KualifikasiController@index') }}`,
                sortBy: `kategori_id`,
                params: {
                    kategori: null
                },
                fields: [{
                    key      : 'kategori',
                },{
                    key      : 'kode',
                    sortable : true,
                },{
                    key      : 'uraian',
                    sortable : true,
                    formatter: value => value.toUpperCase()
                }],
                form: new Form({
                    kategori_id : null,
                    kode        : null,
                    uraian      : null,
                    laki_laki   : 0,
                    perempuan   : 0,
                }, {
                    kategori    : null
                }),
            }
        }
    },
});
</script>
@endpush
