<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Pacientes::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellidos' => $faker->lastName,
        'fecha_nacimiento' => $faker->date(),
        'sexo' => $faker->boolean,
        'fecha_ingreso' => $faker->dateTime(),
    ];
});
