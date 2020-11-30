<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuariosExternos extends Authenticatable
{
    protected $table = 'usuarios_externos';
    protected $fillable = array(
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'sexo',
        'email',
        'usuario',
        'password');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Todos los pacientes por usuario externo
     */
    public function relacionPaciente()
    {
        return $this->hasMany(RelacionesUsuariosExternosConPacientes::class, 'id_usuario_externo');
    }
}
