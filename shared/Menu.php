<?php

namespace Sty;

use JsonSerializable;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class Menu implements JsonSerializable
{
    public static $menu_collection;

    protected $attributes;

    public static function yaml($file)
    {
        if (empty(self::$menu_collection)) {
            self::$menu_collection = self::mapInto(self::readYamlFile($file));
        }

        return self::$menu_collection;
    }

    public static function readYamlFile($file)
    {
        return Yaml::parseFile(base_path($file));
    }

    public static function mapInto(array $items)
    {
        return collect($items)->filter(function ($item, $key) {
            if (!array_has($item, 'permissions')) {
                return true;
            }

            return self::isUserCanAccessMenu($item);
        })->mapInto(self::class);
    }

    public static function isUserCanAccessMenu($menu)
    {
        return Gate::any(array_get($menu, 'permissions'));
    }

    public function __construct($attributes)
    {
        $this->attributes = Collection::wrap($attributes);

        if ($this->has('childs')) {
            $this->put('childs', self::mapInto($this->childs));
        }
    }

    public function __get($attribute)
    {
        return call_user_func([$this, $attribute]);
    }

    public function __call(string $name, array $arguments = null)
    {
        return $this->attributes->get($name, '');
    }

    public function isDropdown()
    {
        return $this->has('childs');
    }

    public function isCurrent()
    {
        return url()->current() == $this->link();
    }

    public function isHeader()
    {
        return $this->type == 'header';
    }

    public function has($key)
    {
        return $this->attributes->has($key);
    }

    public function put(...$args)
    {
        return $this->attributes->put(...$args);
    }

    public function liClass()
    {
        return $this->isDropdown() ? 'nav-dropdown' : '';
    }

    public function class()
    {
        $class = $this->attributes->get('class', '');

        if ($this->isDropdown()) {
            $class .= ' nav-dropdown-toggle';
        }

        return $class;
    }

    public function icon()
    {
        return $this->attributes->get('icon', 'fa fa-circle-o');
    }

    public function link()
    {
        return url($this->attributes->get('link', '#'));
    }

    public function childs()
    {
        return $this->attributes->get('childs');
    }

    public function jsonSerialize()
    {
        return [
            'childs'     => $this->childs,
            'class'      => $this->class,
            'icon'       => $this->icon,
            'is_current' => $this->isCurrent(),
            'is_header'  => $this->isHeader(),
            'link'       => $this->link,
            'title'      => $this->title,
        ];
    }
}
