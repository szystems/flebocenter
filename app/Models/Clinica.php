<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'clinicas';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'celular',
        'email',
        'descripcion',
        'estado'
    ];

    protected $guarded =[

    ];
}
