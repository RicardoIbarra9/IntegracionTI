<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioInternos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_internos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_usuario')->unsigned();
            $table->string('nombre');
            $table->string('apellidos');
            $table->boolean('sexo');
            $table->string('email');
            $table->string('usuario')->unique();
            $table->string('password');
            $table->timestamps();
            $table->foreign('tipo_usuario')
                ->references('id')
                ->on('tipo_usuarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_internos');
    }
}
