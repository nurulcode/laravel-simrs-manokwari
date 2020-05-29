
<form-modal ok-title="Simpan" ref="form_pulang" :form="form_pulang" title="Pasien Pulang">
    <b-form-group v-bind="form_pulang.feedback('waktu_keluar')">
        <b slot="label">Waktu Keluar:</b>
        <date-picker
            alt-format="d/m/Y H:i"
            enable-time
            v-model="form_pulang.waktu_keluar"
            v-on:input="form_pulang.errors.clear('waktu_keluar')"
            >
        </date-picker>
    </b-form-group>
    <b-form-group v-bind="form_pulang.feedback('keadaan_keluar')">
        <b slot="label">Keadaan Keluar:</b>
        <b-form-select
            :options="{{ json_encode(App\Enums\KeadaanKeluar::toSelectOptions()) }}"
            v-on:change="form_pulang.errors.clear('keadaan_keluar')"
            v-model="form_pulang.keadaan_keluar">
            <option slot="first" :value="null" disabled>Pilih Keadaan Pasien</option>
        </b-form-select>
    </b-form-group>
    <b-form-group v-bind="form_pulang.feedback('cara_keluar')">
        <b slot="label">Cara Keluar:</b>
        <b-form-select
            :options="{{ json_encode(App\Enums\CaraKeluar::toSelectOptions()) }}"
            v-on:change="form_pulang.errors.clear('cara_keluar')"
            v-model="form_pulang.cara_keluar">
            <option slot="first" :value="null" disabled>Pilih Cara Keluar</option>
        </b-form-select>
    </b-form-group>
    <b-form-group label="Dirujuk ke:" v-bind="form_pulang.feedback('rujukan')">
        <input
            class="form-control"
            name="rujukan"
            placeholder="Tujuan Rujukan"
            type="text"
            v-model="form_pulang.rujukan"
            >
        </input>
    </b-form-group>
    <b-form-group label="Pindah ke RS:" v-bind="form_pulang.feedback('rs_tujuan')">
        <input
            class="form-control"
            name="rs_tujuan"
            placeholder="Tujuan Rujukan"
            type="text"
            v-model="form_pulang.rs_tujuan"
            >
        </input>
    </b-form-group>
    <b-form-group label="Catatan:" v-bind="form_pulang.feedback('catatan')">
        <textarea
            class="form-control"
            name="catatan"
            placeholder="Catatan"
            type="text"
            v-model="form_pulang.catatan"
            >
        </textarea>
    </b-form-group>
</form-modal>

@push('javascripts')
<script>
window.pagemix.push({
    data() {
        return {
            form_pulang: new Form({
                waktu_keluar  : null,
                keadaan_keluar: null,
                cara_keluar   : null,
                rujukan       : null,
                rs_tujuan     : null,
                catatan       : null
            }),
        };
    },
    methods: {
        pulang() {
            this.form_pulang.waktu_keluar = format(new Date(), 'YYYY-MM-DD HH:mm:ss');

            this.$refs.form_pulang.post(
                `{{ action('Perawatan\RawatInapPulangController', $perawatan->id) }}`
            ).then(response => {
                window.location.reload();
            });
        },
    }
});
</script>
@endpush