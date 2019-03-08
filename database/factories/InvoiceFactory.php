<?php

use App\Invoice;
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

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'address_line_1' => $faker->address,
        'address_line_2' => $faker->address,
        'address_line_3' => $faker->address,
        'address_line_4' => $faker->address,
        'postcode' => $faker->postcode,
    ];
});
