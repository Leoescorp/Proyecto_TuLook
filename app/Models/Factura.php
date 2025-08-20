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
        'Monto_Toltal',
        'Detalles',
        'Estado',
        'ID_Metodo_Pago',
        'cantidad',
        'Usuario_Confirmacion',
        'Fecha_Confirmacion',
        'Usuario_Anulacion',
        'Fecha_Anulacion',
        'Codigo_Acceso'
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
