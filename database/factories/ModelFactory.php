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

$factory->define(Caderneta\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Caderneta\Models\Movimentacoe::class, function (Faker\Generator $faker) {
    return [
        'descricao' => $faker->paragraph,
        'data' => $faker->dateTime,
        'tipoCobranca' => $faker->boolean(),
        'tipoPagto' => $faker->numberBetween(0, 2),
        'total' => $faker->randomFloat(),
    ];
});