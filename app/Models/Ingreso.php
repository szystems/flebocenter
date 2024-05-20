<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleIngreso;
use App\Models\Proveedor;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'proveedor_id',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
        'tipo_pago',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalleIngresos()
    {
        return $this->hasMany(DetalleIngreso::class);
    }
}
