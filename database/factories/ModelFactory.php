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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Map::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'floor' => $faker->randomNumber(3),
		'image' => $faker->name
	];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
	return [
		'route_id' => $faker->randomNumber(2),
		'location_point' => $faker->randomNumber(2),
		'default_person' => $faker->randomNumber(2),
		'name' => $faker->company,
		'branch' => $faker->dayOfWeek,
		'logo' => $faker->image,
		'building' => 'H',
		'room_number' => $faker->randomFloat(2,0,3),
		'description' => $faker->text,
		'status' => 1
	];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
	return [
		'firstname' => $faker->firstName,
		'surname' => $faker->lastName,
		'profilepicture' => $faker->image,
		'company_id'  => $faker->randomNumber(1),
		'telephone' => $faker->phoneNumber,
		'email' => $faker->email,
		'website' => $faker->url,
		'status' => 1
	];
});
