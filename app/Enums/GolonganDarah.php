<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class GolonganDarah extends Enum
{
    const O  = 1;
    const A  = 2;
    const B  = 3;
    const AB = 4;

    public static function getDescription($value): string
    {
        if ($value === self::AB) {
            return 'AB';
        }

        return parent::getDescription($value);
    }
}
