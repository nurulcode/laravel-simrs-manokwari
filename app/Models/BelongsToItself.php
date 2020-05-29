<?php

namespace App\Models;

trait BelongsToItself
{
    public function parent()
    {
        return $this->belongsTo(get_called_class());
    }

    public function childs()
    {
        return $this->hasMany(get_called_class(), 'parent_id');
    }

    public function searchChilds($builder, $searchQuery)
    {
        return $builder->orwhereHas('childs', function ($query) use ($searchQuery) {
            $query->where('uraian', 'like', '%' . $searchQuery . '%');
        });
    }
}
