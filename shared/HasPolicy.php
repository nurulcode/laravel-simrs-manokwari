<?php

namespace Sty;

trait HasPolicy
{
    public function policy()
    {
        return str_replace_first(
            'App\\Models', 'App\\Policies', get_called_class()
        ) . 'Policy';
    }

    public function permissionKeyName()
    {
        return snake_case(str_replace(
            '\\', '_', str_after(get_called_class(), 'App\\Models\\')
        ));
    }
}
