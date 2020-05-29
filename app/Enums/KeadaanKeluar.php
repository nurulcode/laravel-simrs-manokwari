<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class KeadaanKeluar extends Enum implements LocalizedEnum
{
    const SEMBUH              = 1;
    const MEMBAIK             = 2;
    const BELUM_SEMBUH        = 3;
    const MATI_SEBELUM_48_JAM = 4;
    const MATI_SETELAH_48_JAM = 5;
}
