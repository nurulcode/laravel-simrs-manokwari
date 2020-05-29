@component('components.card')
    @slot('header')
        <div class="row justify-content-between">
            <div class="col">
                <h6 class="mb-0">{{ $title ?? '' }}</h6>
            </div>

            <div class="col">
                <h6 class="text-right mb-0"> Nomor Kunjungan: {{ $kunjungan->nomor_kunjungan }} </h6>
            </div>
        </div>
    @endslot

    <div class="row">
        <div class="col">
            <b-form-group label="Pasien:">
                <input
                    class="form-control"
                    disabled
                    placeholder="Nomor Rekam Medis"
                    readonly
                    type="text"
                    value="{{ $kunjungan->pasien->no_rekam_medis }} - {{ $kunjungan->pasien->nama }}"
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Tempat, Tanggal Lahir:">
                <input
                    class="form-control"
                    disabled
                    placeholder="Tanggal Lahir"
                    readonly
                    @if(!empty($kunjungan->pasien->tanggal_lahir))
                        value="{{ $kunjungan->pasien->tanggal_lahir->format('d/m/Y') }}"
                    @endif
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Umur:">
                <input
                    class="form-control"
                    disabled
                    placeholder="Umur"
                    readonly
                    @if(!empty($kunjungan->pasien->tanggal_lahir))
                        value="{{ $kunjungan->pasien->tanggal_lahir->diff(now())->format('%y Tahun %m Bulan') }}"
                    @endif
                    >
                </input>
            </b-form-group>
        </div>
        <div class="col">
            <b-form-group label="Alamat:">
                <input
                    class="form-control"
                    disabled
                    placeholder="Alamat"
                    readonly
                    value="{{ $kunjungan->pasien->alamat }}"
                    >
                </input>
            </b-form-group>
        </div>
    </div>

    @if(isset($footer))

        {{ $slot }}

    @endif

    @if(isset($footer) && !empty($footer->toHtml()))
        @slot('footer')
            {{ $footer }}
        @endslot
    @endif

@endcomponent
