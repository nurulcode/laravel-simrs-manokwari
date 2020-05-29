<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['id' => 1], [
            'name'              => 'Super Administrator',
            'email'             => 'superadmin@mail.com',
            'username'          => 'superadmin',
            'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'active'            => true,
            'email_verified_at' => now(),
            'remember_token'    => str_random(10),
        ])->giveRoleAs('superadmin');
    }
}
