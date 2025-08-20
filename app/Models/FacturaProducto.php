<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaProducto extends Model
{
    protected $table = 'factura_producto';
    protected $primaryKey = 'ID_FacturaProducto';
    public $timestamps = false;

    protected $fillable = ['ID_Factura', 'ID_Producto', 'Cantidad'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'ID_Factura');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }
}
