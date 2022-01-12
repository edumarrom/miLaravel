<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    use HasFactory;

    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'depart';

    protected $fillable = ['denominacion', 'localidad'];

    public function empleados()
    {
        return $this->hasMany(Emple::class);
    }
}
