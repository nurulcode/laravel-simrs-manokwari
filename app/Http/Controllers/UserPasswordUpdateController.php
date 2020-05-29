<?php

namespace App\Http\Controllers;

use Sty\CrudResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserPasswordUpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!(Hash::check($request->input('current_password'), Auth::user()->password))) {
            throw ValidationException::withMessages([
                'current_password' => [trans('auth.password_mismatch')],
            ]);
        }

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed|different:current_password',
        ]);

        //Change Password
        $user           = Auth::user();

        $user->password = bcrypt($request->input('password'));

        $user->save();

        return crud_response($user, CrudResponse::UPDATED);
    }
}
