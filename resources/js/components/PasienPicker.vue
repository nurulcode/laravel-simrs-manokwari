<template>
<div>
    <div class="row">
        <div class="col">
            <b-form-group v-bind="feedback">
                <b slot="label">Pasien:</b>
                <input
                    class="form-control text-right"
                    disabled
                    placeholder="Pasien"
                    readonly
                    type="text"
                    v-if="disabled"
                    v-bind:value="nama"
                    >
                </input>
                <ajax-select :url="url"
                    deselect-label=""
                    label="nama"
                    placeholder="Pilih Pasien"
                    select-label=""
                    v-else
                    v-model="pasien"
                    v-on:select="select"
                    >
                    <template slot="option" slot-scope="{option}">
                        <span>{{ option.no_rekam_medis }} - {{ option.nama }}</span>
                    </template>
                    <template slot="singleLabel" slot-scope="{option}">
                        <span>{{ option.no_rekam_medis }} - {{ option.nama }}</span>
                    </template>
                </ajax-select>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Nomor Rekam Medis:">
                <input
                    class="form-control text-right"
                    disabled
                    placeholder="Nomor Rekam Medis"
                    readonly
                    type="text"
                    v-bind:value="no_rekam_medis"
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group :label="`Nomor Identitas ${jenis_identitas}:`">
                <input
                    class="form-control text-right"
                    disabled
                    placeholder="Nomor Identitas"
                    readonly
                    type="text"
                    v-model="nomor_identitas"
                    >
                </input>
            </b-form-group>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <b-form-group label="Tempat, Tanggal Lahir:">
                <input
                    class="text-right form-control"
                    disabled
                    placeholder="Tempat, Tanggal Lahir"
                    readonly
                    v-bind:value="tempat_tanggal_lahir"
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Alamat:">
                <input
                    class="text-right form-control"
                    disabled
                    placeholder="Alamat"
                    readonly
                    v-bind:value="alamat"
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Telepon/HP:">
                <input
                    class="text-right form-control"
                    disabled
                    placeholder="Telepon/HP"
                    readonly
                    v-bind:value="telepon"
                    >
                </input>
            </b-form-group>
        </div>
    </div>
</div>
</template>

<script>
export default {
    computed: {
        no_rekam_medis() {
            return this.pasien && this.pasien.no_rekam_medis;
        },
        nama() {
            return this.pasien && this.pasien.nama;
        },
        nomor_identitas() {
            return this.pasien && this.pasien.nomor_identitas;
        },
        jenis_identitas() {
            if (!this.pasien) {
                return '';
            }

            return this.pasien.jenis_identitas ? `(${this.pasien.jenis_identitas.uraian})` : '';
        },
        tempat_tanggal_lahir() {
            if (!this.pasien) {
                return;
            }

            if (!this.pasien.tempat_lahir) {
                return this.tanggal_lahir;
            }

            return `${this.pasien.tempat_lahir || ''}, ${this.tanggal_lahir}`
        },
        tanggal_lahir() {
            if (!this.pasien) {
                return;
            }

            if (!this.pasien.tanggal_lahir) {
                return;
            }

            return `${format(parse(this.pasien.tanggal_lahir), 'DD MMMM YYYY')}`;
        },
        alamat() {
            return this.pasien && this.pasien.alamat;
        },
        telepon() {
            return this.pasien && this.pasien.telepon;
        }
    },
    data() {
        return {
            pasien: {
                no_rekam_medis : null,
                nomor_identitas: null,
                jenis_identitas: null,
                tempat_lahir   : null,
                tanggal_lahir  : null,
                alamat         : null,
                telepon        : null
            }
        }
    },
    methods: {
        select(pasien) {
            this.$emit('update:dataPasien', pasien);
            this.$emit('change', pasien);

            this.$emit('input', pasien && pasien.id);
        }
    },
    mounted() {
        this.pasien = this.dataPasien;
    },
    props: {
        dataPasien: Object,
        disabled  : Boolean,
        feedback  : Object,
        url       : String,
        value     : [String, Number],
    },
    watch: {
        dataPasien(value) {
            this.pasien = value;
        }
    }
}
</script>