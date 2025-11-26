<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleIngreso;
use App\Models\Proveedor;

class Ingreso extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'ingresos';

    protected $primaryKey='id';

    protected $fillable = [
        'fecha',
        'proveedor_id',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalleIngresos()
    {
        return $this->hasMany(DetalleIngreso::class);
    }

    public function pago_ingresos()
    {
        return $this->hasMany(PagoIngreso::class);
    }
}
