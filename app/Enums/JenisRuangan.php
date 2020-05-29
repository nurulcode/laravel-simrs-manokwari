<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JenisRuangan extends Enum
{
    const BIASA = 1;
    const ICU   = 2;

    public static function getDescription($value): string
    {
        if ($value === self::ICU) {
            return 'ICU';
        }

        return parent::getDescription($value);
    }
}
