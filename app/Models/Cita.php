<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Especificar la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'citas';

    // Definir los campos asignables en masa
    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'clinica_id',
        'fecha_cita',
        'hora_inicio',
        'hora_fin',
        'motivo',
        'estado',
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    // Relación con el modelo Doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relación con el modelo Clinica
    public function clinica()
    {
        return $this->belongsTo(Clinica::class, 'clinica_id');
    }
}
