<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color';
    protected $primaryKey = 'ID_Color';
    public $timestamps = false;

    protected $fillable = ['N_Color', 'CodigoHex'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_Color');
    }
}
