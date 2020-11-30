<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioInterno extends Authenticatable
{
    protected $table = 'usuario_internos';
    protected $fillable = array(
                            'tipo_usuario',
                            'nombre',
                            'apellidos',
                            'sexo',
                            'correo',
                            'usuario',
                            'contrasena');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Todos los usuario_interno internos por rol
     */
    public function rol()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Todas las notificaciones de los usuario_interno internos
     */
    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class, 'id_usuario_interno');
    }
}
