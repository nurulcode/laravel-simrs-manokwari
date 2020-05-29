<?php

namespace Sty;

use Illuminate\Support\Collection;

trait RequestTransform
{
    public function validated()
    {
        return array_merge($this->map(parent::validated()), $this->with());
    }

    protected function map($data)
    {
        return Collection::wrap($data)->mapWithKeys(
            function ($value, $key) use ($data) {
                $value = $this->mapValue($value, $key, $data);
                $key   = $this->mapKey($key);

                return $value instanceof DropKey ? [] : [$key => $value];
            })->toArray();
    }

    protected function mapKey($key)
    {
        if (!property_exists($this, 'map_keys')) {
            return $key;
        }

        if (!array_has($this->map_keys, $key)) {
            return $key;
        }

        return array_get($this->map_keys, $key, $key);
    }

    protected function mapValue($value, $key, $data)
    {
        if (!property_exists($this, 'map_values')) {
            return $value;
        }

        if (!array_has($this->map_values, $key)) {
            return $value;
        }

        $mapped = array_get($this->map_values, $key);

        if (is_callable($mapped)) {
            return call_user_func_array($mapped, func_get_args());
        }

        if (method_exists($this, $mapped)) {
            return call_user_func_array([$this, $mapped], func_get_args());
        }

        return array_get($data, $mapped, $value);
    }

    public function with()
    {
        return [];
    }
}
