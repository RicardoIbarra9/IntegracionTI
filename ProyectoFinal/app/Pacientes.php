<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $table = 'pacientes';
    protected $fillable = array(
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'sexo',
        'fecha_ingreso',
        'motivo_ingreso',
        'fecha_alta',
        'motivo_alta',
        'fecha_muerte',
        'motivo_muerte',
        'diagnostico');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Todos los usuario_interno externos que tiene el paciente
     */
    public function usuarioExterno()
    {
        return $this->hasMany(RelacionesUsuariosExternosConPacientes::class, 'id_paciente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Todas las notificaciones del paciente
     */
    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class, 'id_paciente')
            ->orderByDesc('fecha');
    }
}
