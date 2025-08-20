<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero';
    protected $primaryKey = 'ID_Genero';
    public $timestamps = false;

    protected $fillable = ['N_Genero'];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'ID_Genero');
    }
}
