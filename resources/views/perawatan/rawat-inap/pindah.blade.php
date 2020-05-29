
<form-modal ok-title="Pindah" ref="form_pindah" :form="form_pindah" title="Pindah Kamar">
    <b-form-group v-bind="form_pindah.feedback('waktu_pindah')">
        <b slot="label">Waktu Pindah:</b>
        <date-picker
            alt-format="d/m/Y H:i"
            enable-time
            v-model="form_pindah.waktu_pindah"
            v-on:input="form_pindah.errors.clear('waktu_pindah')"
            >
        </date-picker>
    </b-form-group>
    <b-form-group v-bind="form_pindah.feedback('poliklinik_id')">
        <b slot="label">Poliklinik Tujuan:</b>
        <b-form-select v-model="form_pindah.poliklinik_id"
            v-on:change="form_pindah.ruangan = null"
            v-on:change="form_pindah.errors.clear('poliklinik_id')"
            >
            <option :value="null" disabled>Pilih Poliklinik Tujuan</option>
            @foreach($polikliniks as $poliklinik)
                <option :value="{{ $poliklinik->id }}">
                    {{ $poliklinik->kode }} - {{ $poliklinik->nama }}
                </option>
            @endforeach
        </b-form-select>
    </b-form-group>
    <b-form-group v-bind="form_pindah.feedback('ruangan_id')">
        <b slot="label">Ruang Rawat Inap:</b>
        <ajax-select
            :params="{poliklinik:form_pindah.poliklinik_id}"
            deselect-label=""
            label="nama"
            placeholder="Pilih ruang rawat inap"
            select-label=""
            url="{{ action('Fasilitas\RuanganController@index') }}"
            v-model="form_pindah.ruangan"
            v-bind:key-value.sync="form_pindah.ruangan_id"
            v-on:change="form_pindah.kamar = null"
            v-on:select="form_pindah.errors.clear('ruangan_id')"
            >
        </ajax-select>
    </b-form-group>
    <b-form-group v-bind="form_pindah.feedback('kamar_id')">
        <b slot="label">Kamar:</b>
        <ajax-select
            :disabled="!form_pindah.ruangan_id"
            :params="{ruangan:form_pindah.ruangan_id}"
            deselect-label=""
            label="nama"
            placeholder="Pilih Kamar"
            select-label=""
            url="{{ action('Fasilitas\KamarController@index') }}"
            v-model="form_pindah.kamar"
            v-bind:key-value.sync="form_pindah.kamar_id"
            v-on:change="form_pindah.ranjang = null"
            v-on:select="form_pindah.errors.clear('kamar_id')"
            >
            <template slot="option" slot-scope="{option}">
                <span>@{{ option.ruangan.nama }} - @{{ option.nama }}</span>
            </template>
            <template slot="singleLabel" slot-scope="{option}">
                <span>@{{ option.ruangan.nama }} - @{{ option.nama }}</span>
            </template>
        </ajax-select>
    </b-form-group>

    <b-form-group v-bind="form_pindah.feedback('ranjang_id')">
        <b slot="label">Ranjang:</b>
        <ajax-select
            :disabled="!form_pindah.kamar_id"
            :params="{kamar:form_pindah.kamar_id,kosong:true}"
            deselect-label=""
            label="kode"
            placeholder="Pilih Ranjang"
            select-label=""
            url="{{ action('Fasilitas\RanjangController@index') }}"
            v-model="form_pindah.ranjang"
            v-bind:key-value.sync="form_pindah.ranjang_id"
            v-on:select="form_pindah.errors.clear('ranjang_id')"
            >
            <template slot="option" slot-scope="{option}">
                <span>
                    @{{ option.ruangan.nama }} -
                    @{{ option.kamar.nama }} -
                    @{{ option.kode }}
                </span>
            </template>
            <template slot="singleLabel" slot-scope="{option}">
                <span>
                    @{{ option.ruangan.nama }} -
                    @{{ option.kamar.nama }} -
                    @{{ option.kode }}
                </span>
            </template>
        </ajax-select>
    </b-form-group>
</form-modal>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_pindah: new Form({
                waktu_pindah : null,
                poliklinik_id: @json($perawatan->poliklinik->id),
                ruangan_id   : @json($perawatan->ruangan->id),
                kamar_id     : @json($perawatan->kamar->id),
                ranjang_id   : @json($perawatan->ranjang->id),
            }, {
                poliklinik   : @json($perawatan->poliklinik),
                ruangan      : @json($perawatan->ruangan),
                kamar        : @json($perawatan->kamar->load('ruangan')),
                ranjang      : @json($perawatan->ranjang->load('ruangan', 'kamar'))
            })
        };
    },
    methods: {
        pindah() {
            this.form_pindah.waktu_pindah = format(new Date(), 'YYYY-MM-DD HH:mm:ss');

            this.$refs.form_pindah.post(
                `{{ action('Perawatan\RawatInapPindahKamarController', $perawatan->id) }}`
            ).then(response => {
                let id    = response.data.data.id;
                let base  = `{{ action('Perawatan\RawatInapWebController@index') }}`

                window.location.replace(`${base}/${id}`);
            });
        }
    }
});
</script>
@endpush