<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Schedule::class, function (Faker $faker) {
    return [
        'stoa_id' => factory(\App\Models\Stoa::class)->create()->id,
        'monday_from' => $faker->time(),
        'monday_to' => $faker->time(),
        'tuesday_from' => $faker->time(),
        'tuesday_to' => $faker->time(),
        'wednesday_from' => $faker->time(),
        'wednesday_to' => $faker->time(),
        'thursday_from' => $faker->time(),
        'thursday_to' => $faker->time(),
        'friday_from' => $faker->time(),
        'friday_to' => $faker->time(),
        'saturday_from' => $faker->time(),
        'saturday_to' => $faker->time(),
        'sunday_from' => $faker->time(),
        'sunday_to' => $faker->time(),
    ];
});
