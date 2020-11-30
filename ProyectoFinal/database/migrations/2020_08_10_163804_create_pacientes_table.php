<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento')->nullable();
            $table->boolean('sexo');
            $table->dateTime('fecha_ingreso');
            $table->string('motivo_ingreso')->nullable();
            $table->dateTime('fecha_alta')->nullable();
            $table->string('motivo_alta')->nullable();
            $table->dateTime('fecha_muerte')->nullable();
            $table->string('motivo_muerte')->nullable();
            $table->string('diagnostico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
