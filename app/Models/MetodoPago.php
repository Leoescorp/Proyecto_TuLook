<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodo_pago';
    protected $primaryKey = 'ID_Metodo_Pago';
    public $timestamps = false;

    protected $fillable = ['T_Pago'];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'ID_Metodo_Pago');
    }
}
