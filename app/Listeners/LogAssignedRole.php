<?php

namespace App\Listeners;

use App\Events\RoleAssigned;
use Illuminate\Support\Facades\Auth;

class LogAssignedRole
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RoleAssigned $event)
    {
        $user    = Auth::user();
        $subject = $event->subject();

        $user->activities()->create([
            'subject_id'   => $subject->id,
            'subject_type' => get_class($subject),
            'type'         => 'assign_roles',
            'before'       => $subject->roles->toJson(),
            'after'        => $subject->fresh()->roles->toJson(),
        ]);
    }
}
