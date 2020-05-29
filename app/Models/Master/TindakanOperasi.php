<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\BelongsToItself;
use App\Models\Tarifable;

class TindakanOperasi extends Model
{
    use BelongsToItself, Tarifable;
}
