<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JenisTransaksi extends Enum
{
    const PENERIMAAN  = 1;
    const PENGELUARAN = 2;
    const KOREKSI     = 3;
    const TRANSFER    = 4;
}
