<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bariatria extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'paciente_id',
        'fecha',
        'peso',
        'talla',
        'cci',
        'cca',
        'ccu',
        'imc',
        'icc',
        'ict',
        'pdf_path',
        'diagnostico',
        'kilocalorias',
        'medicamentos',
        'suplementacion',
        'ejercicios',
        'comentarios'
    ];

    /**
     * Obtener el paciente al que pertenece esta bariatría.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
