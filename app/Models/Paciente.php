<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $primaryKey='id';

    protected $fillable = [
        'nombre',
        'ocupacion',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'celular',
        'direccion',
        'email',
        'dpi',
        'nit',
        'fotografia',
        'estado',
        'fecha_primera_cita',
        'enviado_por_medico',
    ];

    /**
     * Los atributos que deben ser ocultados para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        // Aquí puedes añadir los atributos que no quieres que se muestren
        // por ejemplo 'fotografia', si no deseas exponer la URL en las respuestas JSON
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'estado' => 'boolean',
        // Aquí puedes añadir otros casts si es necesario, por ejemplo:
        // 'email_verified_at' => 'datetime',
    ];

    public function historia()
    {
        return $this->hasOne(Historia::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::created(function (Paciente $paciente) {
            $paciente->historia()->save(new Historia());
        });
    }
}
