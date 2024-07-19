<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoIngreso extends Model
{
    use HasFactory;

    protected $table = 'pago_ingresos';

    protected $primaryKey='id';

    protected $fillable = [
        'ingreso_id',
        'tipo_pago',
        'cantidad',
        'imagen',
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class);
    }

    public function ingresoDetalles()
    {
        return $this->hasMany(IngresoDetalles::class);
    }
}
