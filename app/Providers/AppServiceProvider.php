<?php

namespace App\Providers;

use Sty\CrudResponse;
use BenSampo\Enum\Enum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Response::macro('crud', function ($data, $state = null) {
            return with(new CrudResponse($data, $state))->response();
        });

        Enum::macro('toSelectOptions', function () {
            return Collection::wrap(self::toSelectArray())->map(function ($item, $key) {
                return ['value' => $key, 'text' => $item];
            })->values();
        });

        Enum::macro('toSelectValue', function ($value) {
            if (!is_null($value)) {
                return ['value' => $value, 'label' => self::getDescription($value)];
            }
        });

        Enum::macro('keyDescriptions', function () {
            $keys = self::getKeys();
            $desc = array_values(self::toSelectArray());

            return array_combine($keys, $desc);
        });

        Validator::extend('morph_exists', function ($attribute, $value, $parameters, $validator) {
            $class = array_get($validator->getData(), $parameters[0]);

            if (class_exists($class)) {
                return $class::where('id', $value)->exists();
            }

            return false;
        });

        Carbon::serializeUsing(function ($carbon) {
            return $carbon->format('Y-m-d H:i:s');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
