@extends('layouts.tabs')

@section('title', 'Master Kegiatan Management')

@section('tabs')

<b-tab title="Kategori Kegiatan">
    <data-table v-bind.sync="kategori" ref="table" v-model="selected_kategori">
        <div slot="form">
            <b-form-group v-bind="kategori.form.feedback('uraian')">
                <b slot="label">Uraian:</b>
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="kategori.form.uraian"
                    >
                </input>
            </b-form-group>
        </div>
    </data-table>
</b-tab>
<b-tab title="Kegiatan">
    <closable-card v-if="!!selected_kategori" header="Kategori Terpilih:"
        v-on:close="selected_kategori = null">
        <h5>@{{ selected_kategori.uraian }}</h5>
    </closable-card>

    <data-table v-bind.sync="kegiatan" ref="table">
        <div slot="form">
            <b-form-group label="Uraian:" v-bind="kegiatan.form.feedback('uraian')">
                <input
                    class="form-control"
                    name="uraian"
                    placeholder="Uraian"
                    type="text"
                    v-model="kegiatan.form.uraian"
                    >
                </input>
            </b-form-group>
            <b-form-group label="Kelompok Kegiatan:" v-bind="kegiatan.form.feedback('parent_id')">
                <ajax-select
                    :url="kegiatan.url"
                    label="uraian"
                    placeholder="Pilih Kelompok Kegiatan"
                    v-model="kegiatan.form.parent"
                    v-bind:key-value.sync="kegiatan.form.parent_id"
                    v-on:change="kegiatan.form.errors.clear('parent_id')"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group label="Kategori:" v-bind="kegiatan.form.feedback('kategori')">
                <ajax-select
                    :multiple="true"
                    url="{{ action('Master\KategoriKegiatanController@index') }}"
                    label="uraian"
                    placeholder="Pilih Kategori"
                    v-model="kegiatan.form.kategori"
                    >
                </ajax-select>
            </b-form-group>
            <b-form-group
                horizontal
                :label="`Kode ${kat.uraian}:`"
                :key="key"
                :label-cols="6"
                v-bind="kegiatan.form.feedback(`kategori.${key}.kode`)"
                v-for="(kat, key) in kegiatan.form.kategori"
                >
                <b-form-input
                    :name="`kategori.${key}.kode`"
                    :placeholder="`Kode ${kat.uraian}:`"
                    v-model="kegiatan.form.kategori[key].kode"
                    >
                </b-form-input>
            </b-form-group>
        </div>
        <template slot="uraian" slot-scope="{item}">
            @{{ item.uraian }}
            <span class="text-muted" v-if="item.parent">&nbsp;- @{{ item.parent.uraian }}</span>
            <p>
                <b-badge
                    v-for="kat in item.kategori"
                    class="mr-1"
                    variant="success"
                    v-bind:key="kat.pivot_id"
                    v-text="`${kat.kode} : ${kat.uraian}`"
                    >
                </b-badge>
            </p>
        </template>
    </data-table>
</b-tab>

@endsection

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            kategori: {
                sortBy: `uraian`,
                url   : `{{ action('Master\KategoriKegiatanController@index') }}`,
                fields: [{
                    key     : 'uraian',
                    sortable: true,
                }],
                form: new Form({ uraian: null }),
            },
            kegiatan: {
                sortBy: `uraian`,
                url   : `{{ action('Master\KegiatanController@index') }}`,
                params: {
                    kategori: null
                },
                fields: [
                    {
                        key     : 'uraian',
                        sortable: true,
                    }
                ],
                form: new Form(
                    {
                        uraian   : null,
                        parent_id: null,
                        kategori : [],
                    },
                    {
                        parent   : null
                    }
                ),
            },
            selected_kategori: null
        }
    },
    watch: {
        selected_kategori(value, before) {
            if (value) {
                this.kegiatan.form.kategori.push(value);
            } else {
                this.kegiatan.form.setDefault('kategori', []);

                this.kegiatan.form.kategori = [];
            }

            this.selected_tab = value ? 1 : this.selected_tab;

            this.kegiatan.params.kategori = value && value.id;
        }
    }
});
</script>
@endpush
