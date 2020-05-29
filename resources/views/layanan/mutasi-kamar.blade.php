
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kamar</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Tarif Sarana</th>
            <th>Tarif Pelayanan</th>
            <th>Tarif BHP</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kunjungan->rawat_inaps as $rawat_inap)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $rawat_inap->layanan_kamar->ruangan->nama }} -
                    {{ $rawat_inap->layanan_kamar->kamar->nama}}
                    <p class="text-muted">
                        Ranjang: {{ $rawat_inap->layanan_kamar->ranjang->kode}}
                    </p>
                </td>
                <td>
                    {{ $rawat_inap->layanan_kamar->waktu_masuk->format('d/m/Y') }}
                </td>
                <td>
                    @if ($rawat_inap->layanan_kamar->waktu_keluar)
                        {{ $rawat_inap->layanan_kamar->waktu_keluar->format('d/m/Y') }}
                    @endif
                </td>
                <td>
                    {{ $rawat_inap->layanan_kamar->tarif[App\Enums\JenisTarif::SARANA] }}
                </td>
                <td>
                    {{ $rawat_inap->layanan_kamar->tarif[App\Enums\JenisTarif::PELAYANAN] }}
                </td>
                <td>
                    {{ $rawat_inap->layanan_kamar->tarif[App\Enums\JenisTarif::BHP] }}
                </td>
                <td>
                    <a href="{{ action('Perawatan\RawatInapWebController@show', $rawat_inap->id) }}"
                        class="btn btn-primary"> <i class="icon-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>