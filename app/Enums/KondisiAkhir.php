<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class KondisiAkhir extends Enum implements LocalizedEnum
{
    const DIRAWAT     = 1;
    const MENINGGAL   = 2;
    const PULANG      = 3;
    const RAWAT_INAP  = 4;
    const POLI_LAIN   = 5;
    const RS_LAIN     = 6;
    const PUSKESMAS   = 7;
    const DOA         = 8;
    const LAIN_LAIN   = 9;
}
