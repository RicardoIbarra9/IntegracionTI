<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuarios';
    protected $fillable = array('rol');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Todos los usuario_interno internos
     */
    public function usuariosInternos()
    {
        return $this->hasMany(UsuarioInterno::class, 'tipo_usuario');
    }
}
