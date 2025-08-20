<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
    protected $primaryKey = 'ID_Articulo';
    public $timestamps = false;

    protected $fillable = [
        'N_Articulo',
        'Foto',
        'ID_Categoria',
        'ID_SubCategoria',
        'ID_Genero',
        'IdPrecio',
        'Activo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'ID_Categoria');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'ID_SubCategoria');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'ID_Genero');
    }

    public function precio()
    {
        return $this->belongsTo(Precio::class, 'IdPrecio', 'ID_precio');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_Articulo');
    }

    public function getFotoUrlAttribute()
    {
        return asset($this->Foto);
    }

    public function getDisponibleAttribute()
    {
        return $this->productos->count() > 0;
    }

    // Accesor para stock disponible
    public function getStockDisponibleAttribute()
    {
        return $this->productos->count();
    }
}
