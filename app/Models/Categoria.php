<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'ID_Categoria';
    public $timestamps = false;

    protected $fillable = ['N_Categoria'];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'ID_Categoria');
    }
}
