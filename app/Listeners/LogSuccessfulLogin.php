<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
         * Create the event listener.
         *
         * @return void
         */
    public function __construct(Carbon $carbon, Request $request)
    {
        $this->carbon  = $carbon;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        $user->unsetEventDispatcher();

        session(['user_last_login' => $user->last_login]);
        session(['user_last_ip'    => $user->ip_address]);

        $user->last_login = $this->carbon->now();
        $user->ip_address = $this->request->getClientIp();

        $user->activities()->create([
            'subject_id'   => $user->id,
            'subject_type' => User::class,
            'type'         => 'logged_in',
        ]);

        $user->save();
    }
}
