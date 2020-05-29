<?php

namespace Sty;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait MethodOrderable
{
    public function scopeOrder($builder, $orderBy, $orderDirection)
    {
        if (empty($orderBy) || $orderBy == 'null') {
            return $builder;
        }

        if ($this->hasOrderMethod($orderBy)) {
            $builder = $this->orderByMethod($builder, $orderBy, $orderDirection);
        } else {
            $builder->orderBy($orderBy, $orderDirection);
        }

        if (method_exists($this, 'afterOrder')) {
            $builder = call_user_func_array([$this, 'afterOrder'], func_get_args());
        }

        return $builder;

    }

    public function hasOrderMethod($column)
    {
        return method_exists($this, 'orderBy' . Str::studly($column));
    }

    public function orderByMethod($builder, $orderBy, $orderDirection)
    {
        $method = 'orderBy' . Str::studly($orderBy);

        return call_user_func_array([$this, $method], [$builder, $orderDirection]);
    }
}