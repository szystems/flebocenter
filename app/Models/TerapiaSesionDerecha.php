<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerapiaSesionDerecha extends Model
{
    use HasFactory;

    protected $table = 'terapia_sesion_derechas';

    protected $primaryKey='id';

    protected $fillable = [
        'terapia_id',
        'antes1',
        'antes2',
        'antes3',
        'antes4',
        'despues1',
        'despues2',
        'despues3',
        'despues4',
    ];

    public function terapia()
    {
        return $this->belongsTo(Terapia::class);
    }
}
