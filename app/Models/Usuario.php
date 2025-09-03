<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario'; // 👈 nombre exacto de la tabla
    protected $primaryKey = 'ID_Usuario';
    public $timestamps = false; // 👈 si tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'Nombre_Completo',
        'ID_Rol',
        'ID_TD',
        'N_Documento',
        'Correo',
        'Celular',
        'Contrasena',
        'token_recuperacion',
        'token_expira',
    ];

    // 👇 Muy importante: decirle a Laravel cuál es la columna de password
    protected $hidden = [
        'Contrasena',
        'token_recuperacion',
    ];

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}
