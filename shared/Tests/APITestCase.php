<?php

namespace Sty\Tests;

use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Authenticatable;

trait APITestCase
{
    abstract public function createUser();

    abstract public function createAdmin();

    public function passportActingAs($user, $scope = '*')
    {
        return tap($user, function ($user) use ($scope) {
            Passport::actingAs($user, [$scope]);
        });
    }

    public function actingAs(Authenticatable $user, $driver = null)
    {
        return parent::actingAs($this->passportActingAs($user), $driver);
    }
}
