<?php

namespace Sty;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait Searchable
{
    /**
     * The attributes that are searchable.
     *
     * protected $searchable   = [];
     */

    protected $schemaColumn = [];

    public function scopeSearch($builder, $query)
    {
        $context = $this;

        return $builder->where(function ($builder) use ($context, $query) {
            $parsedQuery = $context->parseQuery($query);

            $builder     = $context->multiColumnSearch($builder, ...$parsedQuery);
        });
    }

    public function parseQuery($query) : array
    {
        $exact = $this->isExactSearch($query);

        $query = $this->unformatQuery($query);

        return [$query, $exact];
    }

    public function isExactSearch($query) : bool
    {
        return preg_match_all('(["\']([^"]+)["\'])', $query) === 1;
    }

    public function unformatQuery($query)
    {
        return trim($query, '"\' ');
    }

    public function multiColumnSearch($builder, $query, $exact = false)
    {
        foreach ($this->getColumns($builder) as $column) {
            $builder = $this->singleColumnSearch($builder, $column, $query, $exact);
        }

        return $builder;
    }

    public function getColumns($builder)
    {
        if (property_exists($this, 'searchable')) {
            return $this->searchable;
        }

        return $this->getColumnsFromSchema($builder);
    }

    public function getColumnsFromSchema($builder)
    {
        $connection = $builder->getConnection();
        $connection = $connection->getConfig('name');

        if (empty($this->schemaColumn)) {
            $this->schemaColumn = DB::connection($connection)
                ->getSchemaBuilder()
                ->getColumnListing($this->getTable());
        }

        return $this->schemaColumn;
    }

    public function singleColumnSearch($builder, $column, $query, $exact = false)
    {
        if (!in_array($column, $this->getColumns($builder)) || $query == '') {
            return $builder;
        }

        if ($this->hasSearchMethod($column)) {
            return $this->methodSearch($builder, $column, $query, $exact);
        }

        if ($exact) {
            return $builder->orWhere($this->getTable() . '.' . $column, '=', "$query");
        } else {
            return $builder->orWhere($this->getTable() . '.' . $column, 'LIKE', "%$query%");
        }
    }

    public function hasSearchMethod($column)
    {
        return method_exists($this, 'search' . Str::studly($column));
    }

    public function methodSearch($builder, $column, $searchQuery, $exact = false)
    {
        $method = [$this, 'search' . Str::studly($column)];

        return call_user_func_array($method, [$builder, $searchQuery, $exact]);
    }
}
