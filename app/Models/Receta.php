<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'descripcion',
        'fecha',
        'paciente_id', // Agrega el campo de la clave foránea
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
