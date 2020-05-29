<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class JenisKelamin extends Enum implements LocalizedEnum
{
    const MALE   = 'L';
    const FEMALE = 'P';
}
