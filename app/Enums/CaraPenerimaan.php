<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class CaraPenerimaan extends Enum implements LocalizedEnum
{
    const URJ   = 1;
    const IRD   = 2;
    const TP2RI = 3;
}
