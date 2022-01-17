<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['dni', 'nombre'];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    /**
     * Si la relación cliente_factura es 1:n y factura_linea es 1:n
     */
    public function lineas()
    {
        return $this->hasManyThrough(Linea::class, Factura::class);
    }


}
