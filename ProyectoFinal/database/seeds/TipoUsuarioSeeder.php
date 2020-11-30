<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuarios')->insert([
            'id' => 1,
            'rol' => 'Doctor'
        ]);
        DB::table('tipo_usuarios')->insert([
            'id' => 2,
            'rol' => 'Enfermero'
        ]);
        DB::table('tipo_usuarios')->insert([
            'id' => 3,
            'rol' => 'Personal Auxiliar'
        ]);
        DB::table('tipo_usuarios')->insert([
            'id' => 4,
            'rol' => 'No Catálogo'
        ]);
    }
}
