<?php
    use App\Enums\JenisTarif;
    use Illuminate\Support\Collection;
?>

<tr>
    <td colspan="8" class="font-weight-bold text-uppercase text-center">
        {{ $perawatan->poliklinik->nama }}
    </td>
</tr>

@foreach ($perawatan->tarifable_layanan() as $layanan => $layanan_title)
    @if (Collection::wrap($perawatan->{$layanan})->isNotEmpty())
        <tr>
            <td colspan="8" class="font-weight-bold text-uppercase">{{ $layanan_title }}</td>
        </tr>
    @endif

    @foreach (Collection::wrap($perawatan->{$layanan}) as $tindakan)
        <tr>
            <td>
                {{ $tindakan->uraian }}
                @if ($tindakan->subUraian)
                    <p class="text-muted">{{ $tindakan->subUraian }} </p>
                @endif
            </td>
            <td class="text-right">{{ $tindakan->jumlah }}</td>
            <td class="text-right">{{ $tindakan->tarif[JenisTarif::SARANA] }}</td>
            <td class="text-right">{{ $tindakan->tarif[JenisTarif::PELAYANAN] }}</td>
            <td class="text-right">{{ $tindakan->tarif[JenisTarif::BHP] }}</td>
            <td class="text-right">{{ $tindakan->total_tarif }}</td>
            <td class="text-right">0</td>
            <td class="text-right">{{ $tindakan->total_tarif }}</td>
        </tr>
    @endforeach
@endforeach

@each('kunjungan.penunjangs', $perawatan->penunjangs, 'penunjang')

@if ($perawatan->resep)
    <tr>
        <td colspan="8" class="font-weight-bold text-uppercase">Obat/Alkes</td>
    </tr>

    @each('kunjungan.obat', $perawatan->resep->obats, 'obat')
@endif