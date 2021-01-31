<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'phone' => $faker->unique()->phoneNumber,
        'amount' => $faker->numberBetween(1, 9999),
        'created' => $faker->dateTimeBetween('-10 days', '-6 days'),
        'call_date' => $faker->dateTimeBetween('-5 days', 'now'),
        'status' => $faker->numberBetween(1, 4),
        'manager_id' => $faker->numberBetween(1, 100)
    ];
});
