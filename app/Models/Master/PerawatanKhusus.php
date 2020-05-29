<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Tarifable;
use App\Models\BelongsToItself;

class PerawatanKhusus extends Model
{
    use Tarifable, BelongsToItself;
}
