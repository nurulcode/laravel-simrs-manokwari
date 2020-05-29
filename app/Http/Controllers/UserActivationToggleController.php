<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserActivationToggleController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('can:manage_user');
    }

    public function __invoke(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            return abort(403);
        }

        return response()->crud(new UserResource(
            tap($user, function ($user) use ($request) {
                $currentState = $user->active;
                $user->active = $request->input('active', !$currentState);

                $user->save();
            })
        ));
    }
}
