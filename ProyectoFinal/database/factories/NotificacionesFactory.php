<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Notificaciones::class, function (Faker $faker) {
    return [
        'id_usuario_interno' => $faker->numberBetween(1,21),
        'id_paciente' => $faker->numberBetween(1,21),
        'titulo' => $faker->word(),
        'detalle' => $faker->text(50),
        'fecha' => $faker->dateTime(),
        'visto' => $faker->boolean(),
    ];
});
