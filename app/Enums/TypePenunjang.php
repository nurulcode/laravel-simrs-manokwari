<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class TypePenunjang extends Enum implements LocalizedEnum
{
    const LABORATORIUM       = '4';
    const RADIOLOGI          = '5';
    const REHABILITASI_MEDIK = '6';
    const OPERASI            = '7';
    const INSENERATOR        = '8';
    const UTDRS              = '9';
    const KAMAR_JENAZAH      = '10';
}
