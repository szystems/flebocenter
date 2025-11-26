<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleVenta;
use App\Models\Paciente;

class Venta extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'ventas';

    protected $primaryKey='id';

    protected $fillable = [
        'fecha',
        'paciente_id',
        'tipo_comprobante',
        'serie_comprobante',
        'numero_comprobante',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function pago_ingresos()
    {
        return $this->hasMany(PagoVenta::class);
    }
}
