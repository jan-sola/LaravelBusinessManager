<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
*	Base user factory
*/
$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
				'isAdmin' => false,
    ];
});

/*
*	Admin user factory
*/
$factory->defineAs(App\User::class, 'admin', function ($faker) use ($factory){
		$user = $factory->raw(App\User::class);
		
		return array_merge($user, ['isAdmin' => true]);
});

/*
*	Business factory
*/
$factory->define(App\Business::class, function($faker){
	return [
		'name' => $faker->company,
		'description' => $faker->text,
		'ownerId' => 1,
		'imagePath' => '/img/default.jpg',
		'phoneNumber' => $faker->phoneNumber,
		'website' => 'http://www.example.com',
	];
});
