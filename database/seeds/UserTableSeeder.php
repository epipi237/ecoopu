<?php

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'User',
        'username' => 'user',
        'email'    => 'user@user.com',
        'password' => Hash::make('user'),
    ));
}

}