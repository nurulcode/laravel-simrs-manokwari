<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StatusPernikahan extends Enum
{
    const BELUM_MENIKAH = 0;
    const MENIKAH       = 1;
    const JANDA         = 2;
    const DUDA          = 3;
}
