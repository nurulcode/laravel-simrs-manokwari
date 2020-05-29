<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class KelasTarif extends Enum implements LocalizedEnum
{
    const TARIF_UMUM    = '0';
    const KELAS_I       = KelasRuangan::I;
    const KELAS_II      = KelasRuangan::II;
    const KELAS_III     = KelasRuangan::III;
    const KELAS_VIP     = KelasRuangan::VIP;
    const KELAS_VVIP    = KelasRuangan::VVIP;
    const KELAS_KS      = KelasRuangan::KS;
}
