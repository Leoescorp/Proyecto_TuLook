<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = false;

    protected $fillable = ['ID_Articulo', 'ID_Talla', 'ID_Color', 'Cantidad'];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'ID_Articulo');
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class, 'ID_Talla');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'ID_Color');
    }

    public function facturas()
    {
        return $this->hasMany(FacturaProducto::class, 'ID_Producto');
    }

    // Accesor para disponibilidad
    public function getDisponibleAttribute()
    {
        // Si en el futuro añades stock por producto, puedes implementarlo aquí
        return true;
    }
}