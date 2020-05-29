<?php

namespace Sty;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HttpQuery extends Query
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $builder = $this->call([$this, $filter], $builder, $value);
            }
        }

        if ($this->request->filled('limit')) {
            return $this->paginate($builder, $this->request->input('limit'));
        }

        return $builder->get();
    }

    protected function call($callable, $builder, $value)
    {
        return call_user_func_array($callable, $this->normalize($builder, $value));
    }

    public function filters()
    {
        return $this->request->all();
    }

    public function get($key, $default = null)
    {
        return $this->request->input($key, $default);
    }

    public function has($key)
    {
        return $this->request->has($key);
    }
}
