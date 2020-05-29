<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Sty\Tests\APITestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserPasswordUpdateTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_change_password()
    {
        $password_lama = 'password-lama';
        $password_baru = 'password-baru';

        $user = factory(User::class)->create(['password' => bcrypt($password_lama)]);
        $hash = $user->password;

        $this->withExceptionHandling()
             ->signIn($user)
             ->putJson(action('UserPasswordUpdateController'), [
                'current_password'      => $password_lama,
                'password'              => $password_baru,
                'password_confirmation' => $password_baru])
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing('users', [
            'id'       => $user->id,
            'username' => $user->username,
            'password' => $hash
        ]);

        $dbpass = DB::table('users')
            ->select('password')
            ->where('id', $user->id)
            ->first()
            ->password;

        $this->assertTrue(Hash::check($password_baru, $dbpass));
    }

    /** @test */
    public function user_can_not_change_to_same_password()
    {
        $password_lama = 'password-lama';
        $password_baru = 'password-baru';

        $user = factory(User::class)->create(['password' => bcrypt($password_lama)]);

        $this->withExceptionHandling()
             ->signIn($user)
             ->putJson(action('UserPasswordUpdateController'), [
                'current_password'      => $password_lama,
                'password'              => $password_lama,
                'password_confirmation' => $password_lama])
             ->assertJsonValidationErrors(['password'])->assertStatus(422);

        $this->assertDatabaseHas('users', ['password' => $user->password]);
    }

    /** @test */
    public function user_can_not_change_password_without_current_password()
    {
        $password_lama = 'password-lama';
        $password_baru = 'password-baru';

        $user = factory(User::class)->create(['password' => bcrypt($password_lama)]);

        $this->withExceptionHandling();

        $this->signIn($user)
             ->putJson(action('UserPasswordUpdateController'), [
                'password'              => $password_lama,
                'password_confirmation' => $password_lama])
             ->assertJsonValidationErrors(['current_password'])
             ->assertStatus(422);

        $this->signIn($user)
             ->putJson(route('user.password'), [
                'current_password'      => str_random(100),
                'password'              => $password_lama,
                'password_confirmation' => $password_lama])
             ->assertJsonValidationErrors(['current_password'])
             ->assertStatus(422);

        $this->assertDatabaseHas('users', ['password' => $user->password]);
    }
}
