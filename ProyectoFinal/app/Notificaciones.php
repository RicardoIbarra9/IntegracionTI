<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';
    protected $fillable = array(
                            'id_usuario_interno',
                            'id_paciente',
                            'titulo',
                            'detalle',
                            'fecha',
                            'visto'
                            );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Todas las notificaciones por paciente
     */
    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'id_paciente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Todas las notificaciones por usuario interno
     */
    public function usuarioInterno()
    {
        return$this->belongsTo(UsuarioInterno::class, 'id_usuario_interno');
    }
}
