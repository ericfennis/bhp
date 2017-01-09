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
	$building = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
	$l = array_rand($building);
	$branch = ['Kapper','Onderwijsinstelling','Communicatiebureau','Café','Pottenbakker','Atelier','Tattooshop','Theater','Videoproductie','Advocatenbureau','Bakker','Flexplek','Sierraden','Winkel','Webbureau','Interieurarchitect'];
	$b = array_rand($branch);

	return [
		'walkpath_id' => $faker->randomNumber(2),
		'location_point' => $faker->randomNumber(2),
		'default_person' => $faker->randomNumber(2),
		'telephone' => $faker->phoneNumber,
		'email' => $faker->email,
		'name' => $faker->company,
		'branch' => $branch[$b],
		'logo' => $faker->imageUrl($width = 128, $height = 128),
		'building' => $building[$l],

		'room_number' => $faker->randomFloat(2,0,3),
		'description' => $faker->text,
		'status' => 1
	];
});

$factory->define(App\Person::class, function (Faker\Generator $faker) {
	return [
		'firstname' => $faker->firstName,
		'surname' => $faker->lastName,
		'profilepicture' => $faker->imageUrl($width = 128, $height = 128),
		'company_id'  => $faker->randomNumber(1),
		'telephone' => $faker->phoneNumber,
		'email' => $faker->email,
		'website' => $faker->url,
		'status' => 1
	];
});


$factory->define(App\Point::class, function (Faker\Generator $faker) {
	return [
		'map_id' => $faker->randomNumber(1),
		'x' => $faker->randomNumber(2),
		'y' => $faker->randomNumber(2)
	];
});

$factory->define(App\WalkpathPoint::class, function (Faker\Generator $faker) {
	return [
		'walkpath_id' => $faker->randomNumber(2),
		'point_id' => $faker->randomNumber(1),
		'point_order' => $faker->randomNumber(1),
	];
});

$factory->define(App\Walkpath::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'description' => $faker->text,
		'status' => 1
	];
});

