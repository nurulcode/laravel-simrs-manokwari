<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SistemPembayaran extends Enum
{
    const TUNAI  = 1;
    const HUTANG = 2;
}
