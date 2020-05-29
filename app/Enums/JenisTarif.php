<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class JenisTarif extends Enum implements LocalizedEnum
{
    const SARANA    = 'SARANA';
    const PELAYANAN = 'PELAYANAN';
    const BHP       = 'BHP';
}
