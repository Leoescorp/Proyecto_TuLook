<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'precio';
    protected $primaryKey = 'ID_precio';
    public $timestamps = false;

    protected $fillable = ['Valor', 'Activo', 'FechaAct'];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'IdPrecio', 'ID_precio');
    }
}
