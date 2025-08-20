<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'talla';
    protected $primaryKey = 'ID_Talla';
    public $timestamps = false;

    protected $fillable = ['N_Talla'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_Talla');
    }
}
