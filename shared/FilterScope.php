<?php

namespace Sty;

trait FilterScope
{
    public function scopeFilter($builder, Query $filters)
    {
        return $filters->apply($builder);
    }
}
