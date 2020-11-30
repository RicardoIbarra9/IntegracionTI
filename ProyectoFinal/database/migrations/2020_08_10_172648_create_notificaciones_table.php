<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario_interno')->unsigned();
            $table->bigInteger('id_paciente')->unsigned();
            $table->string('titulo');
            $table->string('detalle');
            $table->dateTime('fecha');
            $table->boolean('visto')->default(false);
            $table->foreign('id_usuario_interno','id_usuario_interno_FK')
                ->references('id')
                ->on('usuario_internos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_paciente', 'id_paciente_notificaciones_FK')
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
        Schema::dropIfExists('notificaciones');
    }
}
