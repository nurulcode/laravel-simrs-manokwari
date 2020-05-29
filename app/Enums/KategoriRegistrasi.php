<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class KategoriRegistrasi extends Enum implements LocalizedEnum
{
    const PASIEN_BARU   = 1;
    const RAWAT_JALAN   = 2;
    const RAWAT_INAP    = 3;
    const GAWAT_DARURAT = 4;
}
