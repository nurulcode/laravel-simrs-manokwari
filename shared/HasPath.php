<?php

namespace Sty;

trait HasPath
{
    public function initializeHasPath()
    {
        array_push($this->appends, 'path');
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function path($action = 'show')
    {
        if ($action == 'view') {
            return action([$this->viewController()], $this->routeParams($action));
        }

        return action([$this->controller(), $action], $this->routeParams($action));
    }

    public function controller()
    {
        return str_replace_first(
            'App\\Models', 'App\\Http\\Controllers', get_called_class()
        ) . 'Controller';
    }

    protected function routeParams($action)
    {
        if (in_array($action, ['show', 'update', 'delete'])) {
            return ['id' => $this->id];
        }

        return [];
    }
}
