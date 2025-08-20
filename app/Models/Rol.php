<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'ID_Rol';
    public $timestamps = false;

    protected $fillable = ['Roles'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'ID_Rol');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'ID_Rol', 'ID_Permiso');
    }
}
