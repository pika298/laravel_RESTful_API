<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
// use Laracasts\TestDummy\Factory as TestDummy;

class OAuthClientTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');

    	\App\OAuthClient::create([
    		'id' => 'GXvOWazQ3lA6YSaFji',
    		'secret' => 'GXvOWazQ3lA.6/YSaFji',
    		'name' => 'Android'
    		]);

    	\App\OAuthClient::create([
    		'id' => 'f3d259ddd3ed8ff3843839b',
    		'secret' => 'G4c7f6f8fa93d59c45502c0ae8c4a95b',
    		'name' => 'Website'
    		]);
    }
}
