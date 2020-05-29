<?php

namespace Tests\Feature;

use Mockery;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Listeners\LogSuccessfulLogin;

class AuthenticationTest extends TestCase
{
    /** @test */
    public function it_record_the_logged_in_user()
    {
        $user    = factory(User::class)->create();

        $carbon  = Mockery::mock(Carbon::class);
        $request = Mockery::mock(Request::class);
        $time    = Carbon::now();

        $ipaddr  = '192.168.100.1';

        $carbon->shouldReceive('now')
               ->once()
               ->andReturn($time);

        $request->shouldReceive('getClientIp')
                ->once()
                ->andReturn($ipaddr);

        Auth::login($user);

        $this->assertDatabaseMissing('users', [
            'username'   => $user->username,
            'ip_address' => null,
            'last_login' => null
        ]);

        Auth::logout();

        $listener = new LogSuccessfulLogin($carbon, $request);

        $listener->handle(new Login('web', $user, false));

        $this->assertDatabaseHas('users', [
            'username'   => $user->username,
            'ip_address' => $ipaddr,
            'last_login' => $time->toDateTimeString()
        ]);
    }
}
