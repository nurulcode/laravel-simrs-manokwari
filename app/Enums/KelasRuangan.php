<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class KelasRuangan extends Enum
{
    const I    = '1';
    const II   = '2';
    const III  = '3';
    const VIP  = '4';
    const VVIP = '5';
    const KS   = '6';

    public static function getDescription($value): string
    {
        return self::getKey($value);
    }
}
