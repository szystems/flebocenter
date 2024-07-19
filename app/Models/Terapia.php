<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terapia extends Model
{
    use HasFactory;

    protected $table = 'terapias';

    protected $primaryKey='id';

    protected $fillable = [
        'paciente_id',
        'talla_media',
        'diagnostico',
        'observaciones',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
