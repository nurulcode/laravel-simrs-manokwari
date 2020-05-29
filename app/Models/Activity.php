<?php

namespace App\Models;

use Sty\Searchable;
use Sty\FilterScope;
use Sty\MethodOrderable;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use FilterScope, Searchable, MethodOrderable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
