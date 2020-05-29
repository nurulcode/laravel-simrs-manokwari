<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class GroupedQuery extends HttpQuery
{
    public function grouped($builder, $value = false)
    {
        if (!$value) {
            return $builder;
        }

        $search = $this->request->input('search');

        return $builder->with(['childs' => function ($query) use ($search) {
            if (!!$search) {
                $query->where('uraian', 'LIKE', '%' . $search . '%');
            }
        }])->where('parent_id', null);
    }

    public function parent($builder, $value)
    {
        return $builder->where('parent_id', null);
    }
}
