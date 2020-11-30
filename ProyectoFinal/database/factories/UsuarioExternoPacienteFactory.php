<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\RelacionesUsuariosExternosConPacientes::class, function (Faker $faker) {
    return [
        'id_usuario_externo' => $faker->numberBetween(1,21),
        'id_paciente' => $faker->numberBetween(1,21),
        'parentesco' => $faker->randomElement(array('Padre', 'Madre', 'Tio', 'Tia', 'Amigo', 'Hijo', 'Hija')),
    ];
});
