<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class CaraKeluar extends Enum implements LocalizedEnum
{
    const DIIJINKAN                 = 1;
    const PULANG_PAKSA              = 2;
    const DIRUJUK                   = 3;
    const DIKEMBALIKAN_KE_PUSKESMAS = 4;
    const DIKEMBALIKAN_KE_FASLIAN   = 5;
    const DIKEMBALIKAN_KE_RS        = 6;
    const LARI                      = 7;
    const PINDAH_RS                 = 8;
}
