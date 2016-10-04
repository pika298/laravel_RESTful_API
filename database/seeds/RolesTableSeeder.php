<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = 'Product Owner'; // optional
        $owner->description = 'Product owner is the owner of a given project'; // optional
        $owner->save();

        $owner = new Role();
        $owner->name = 'admin';
        $owner->display_name = 'Admin Owner'; // optional
        $owner->description = 'Admin owner is the owner of a given project'; // optional
        $owner->save();
    }
}
