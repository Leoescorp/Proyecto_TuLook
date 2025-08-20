<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria';
    protected $primaryKey = 'ID_SubCategoria';
    public $timestamps = false;

    protected $fillable = ['SubCategoria'];

    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'ID_SubCategoria');
    }
}
