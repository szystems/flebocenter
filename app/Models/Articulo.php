<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'articulos';

    protected $fillable = [
        'nombre',
        'codigo',
        'imagen',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'stock',
        'stock_minimo',
        'categoria_id',
        'proveedor_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

}
