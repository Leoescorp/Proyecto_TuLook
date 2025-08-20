<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'ID_Usuario';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Completo',
        'ID_Rol',
        'ID_TD',
        'N_Documento',
        'Correo',
        'Celular',
        'Contrasena',
        'token_recuperacion',
        'token_expira'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'ID_Rol');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'ID_TD');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'ID_Usuario');
    }
}
