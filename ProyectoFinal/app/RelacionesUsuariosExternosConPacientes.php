<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacionesUsuariosExternosConPacientes extends Model
{
    protected $table = 'relaciones_usuarios_externos_con_pacientes';
    protected $fillable = array(
        'id_usuario_externo',
        'id_paciente',
        'parentesco',
      );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Todos los usuario_interno externos por paciente
     */
    public function usuarioExterno()
    {
        return $this->belongsTo(UsuariosExternos::class, 'id_usuario_externo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Todos los pacientes por usuario externo
     */
    public function pacientes()
    {
        return $this->belongsTo(Pacientes::class, 'id_paciente');
    }
}
