<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TipoUsuarioSeeder::class);
         factory(\App\UsuarioInterno::class)->times(1)->create();
//         factory(\App\UsuariosExternos::class)->times(21)->create();
//         factory(\App\Pacientes::class)->times(21)->create();
//         factory(\App\RelacionesUsuariosExternosConPacientes::class)->times(21)->create();
//         factory(\App\Notificaciones::class)->times(21)->create();
    }
}
