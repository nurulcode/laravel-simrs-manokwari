<?php

namespace App\Listeners;

use App\Models\User;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        $user->activities()->create([
            'subject_id'   => $user->id,
            'subject_type' => User::class,
            'type'         => 'logged_out',
        ]);
    }
}
