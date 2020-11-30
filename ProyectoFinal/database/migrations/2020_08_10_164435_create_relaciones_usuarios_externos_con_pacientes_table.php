<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionesUsuariosExternosConPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relaciones_usuarios_externos_con_pacientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario_externo')->unsigned();
            $table->bigInteger('id_paciente')->unsigned();
            $table->string('parentesco');
//            $table->primary(['id_usuario_externo', 'id_paciente'], 'ids_relaciones_PK');
            $table->foreign('id_usuario_externo', 'id_usuario_externo_FK')
                ->references('id')
                ->on('usuarios_externos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_paciente', 'id_paciente_FK')
                ->references('id')
                ->on('pacientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('relaciones_usuarios_externos_con_pacientes');
    }
}
