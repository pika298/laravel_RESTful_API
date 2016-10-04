<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        User::create([
        	'email' => 'test@dummy.com',
        	'phone' => '+85-2345621',
        	'password' => Hash::make('test123')
        	]);
    }
}
