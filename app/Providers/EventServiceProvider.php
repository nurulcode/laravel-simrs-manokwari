<?php

namespace App\Providers;

use App\Events\RoleAssigned;
use Illuminate\Auth\Events\Login;
use App\Listeners\LogAssignedRole;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Support\Facades\Event;
use App\Listeners\LogSuccessfulLogout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        RoleAssigned::class => [
            LogAssignedRole::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
