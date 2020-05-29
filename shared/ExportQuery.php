<?php

namespace Sty;

use Illuminate\Database\Eloquent\Builder;

class ExportQuery extends Query
{
    protected $request;

    public function apply(Builder $builder)
    {
        foreach ($this->filters() as $filter => $value) {
            if (!method_exists($this, $filter)) {
                continue;
            }

            $builder = call_user_func_array([$this, $filter], $this->normalize($builder, $value));
        }

        return $builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
