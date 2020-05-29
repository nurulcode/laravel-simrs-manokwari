<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\BelongsToItself;
use App\Models\Tarifable;

class Utdrs extends Model
{
    use BelongsToItself, Tarifable;
}
