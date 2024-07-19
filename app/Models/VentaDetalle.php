<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    protected $table = 'venta_detalles';

    protected $primaryKey='id';

    protected $fillable = [
        'venta_id',
        'articulo_id',
        'cantidad',
        'precio_compra',
        'precio_venta',
        'descuento',
        'sub_total',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
