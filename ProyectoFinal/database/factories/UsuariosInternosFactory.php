<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\UsuarioInterno::class, function (Faker $faker) {
    return [
        'tipo_usuario' => $faker->numberBetween(1,4),
        'nombre' => $faker->name,
        'apellidos' => $faker->lastName,
        'sexo' => $faker->boolean,
        'email' => $faker->unique()->safeEmail,
        'usuario' => $faker->unique()->userName,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
