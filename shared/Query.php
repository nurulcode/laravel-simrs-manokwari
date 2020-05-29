<?php

namespace Sty;

use Illuminate\Database\Eloquent\Builder;

abstract class Query
{
    abstract public function apply(Builder $builder);

    abstract public function filters();

    public function normalize($builder, $input)
    {
        $input = is_array($input) ? $input : [$input];

        return array_filter(array_prepend($input, $builder));
    }

    public function paginate($builder, $limit)
    {
        return $builder->paginate($limit);
    }

    public function sortBy($builder, $sortBy, $sortDirection = 'asc')
    {
        return $this->orderBy(...func_get_args());
    }

    public function orderBy($builder, $orderBy, $orderDirection = 'asc')
    {
        if (empty($orderBy) || $orderBy == 'null') {
            return $builder;
        }

        return $builder->order($orderBy, $orderDirection);
    }

    public function search($builder, $query = '')
    {
        return $query ? $builder->search($query) : $builder;
    }
}
