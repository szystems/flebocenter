<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingreso;
use App\Models\Articulo;

class IngresoDetalle extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'ingreso_detalles';

    protected $primaryKey='id';

    protected $fillable = [
        'ingreso_id',
        'articulo_id',
        'cantidad',
        'precio_compra',
        'sub_total',
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
