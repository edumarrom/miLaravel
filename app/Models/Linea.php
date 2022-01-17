<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = ['factura_id', 'articulo_id', 'cantidad'];

    public $incrementing = true;

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id'); // SObraría el 2do argumento
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'articulo_id');
    }
}
