<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';
    protected $primaryKey = 'ID_TD';
    public $timestamps = false;

    protected $fillable = ['Documento'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'ID_TD');
    }
}
