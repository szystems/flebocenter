<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoVenta extends Model
{
    use HasFactory;

    protected $table = 'pago_ventas';

    protected $primaryKey='id';

    protected $fillable = [
        'venta_id',
        'tipo_pago',
        'cantidad',
        'imagen',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function ingresoVentas()
    {
        return $this->hasMany(IngresoVentas::class);
    }
}
