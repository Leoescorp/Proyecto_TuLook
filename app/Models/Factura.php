<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'ID_Factura';
    public $timestamps = false;

    protected $fillable = [
        'ID_Usuario',
        'Fecha_Factura',
        'Monto_Total',
        'Direccion_Envio',
        'Estado',
        'ID_Metodo_Pago',
        'Codigo_Acceso',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'ID_Metodo_Pago');
    }

    public function productosFactura()
    {
        return $this->hasMany(FacturaProducto::class, 'ID_Factura');
    }
}