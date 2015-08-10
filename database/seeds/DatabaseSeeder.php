<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
				
				//Create one administrator user
				App\User::create([
					'name' => 'Jan (Admin)',
					'password' => bcrypt('jan123'),
					'email' => 'administrator@gmail.com',
					'isAdmin' => true,
				]);
				
				//Create some users and assign a business for them to follow
				factory('App\User', 5)->create()->each(function($u){
					$u->following()->save(factory('App\Business')->make());
				});

				//Create some admin users
				factory('App\User', 'admin', 3)->create();
				
				//Create some businesses
				factory('App\Business', 3)->create();
				
        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
