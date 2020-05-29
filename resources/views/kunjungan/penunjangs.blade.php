<?php use App\Enums\JenisTarif; ?>
<tr>
    <td colspan="8" class="font-weight-bold text-uppercase">
        Layanan {{ $penunjang->title }}
    </td>
</tr>
@foreach ($penunjang->tindakans as $tindakan)
    <tr>
        <td>{{ $tindakan->uraian }}</td>
        <td class="text-right">{{ $tindakan->jumlah }}</td>
        <td class="text-right">{{ $tindakan->tarif[JenisTarif::SARANA] }}</td>
        <td class="text-right">{{ $tindakan->tarif[JenisTarif::PELAYANAN] }}</td>
        <td class="text-right">{{ $tindakan->tarif[JenisTarif::BHP] }}</td>
        <td class="text-right">{{ $tindakan->total_tarif }}</td>
        <td class="text-right">0</td>
        <td class="text-right">{{ $tindakan->total_tarif }}</td>
    </tr>
@endforeach