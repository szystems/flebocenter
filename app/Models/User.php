<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as',
        'fotografia',
        'estado',
        'principal',
        'fecha_nacimiento',
        'telefono',
        'celular',
        'direccion',
        'colegiado',
        'descripcion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTimeZoneAttribute($value): string
    {
        return $value == config('app.timezone') || empty($value) ? config('app.timezone') : $value;
    }

    public function setTimeZoneAttribute($value)
    {
        $this->attributes['timezone'] = $value == config('app.timezone') || is_null($value) ? null : $value;
    }

    public function getCreatedAtAttribute($value): Carbon
    {
        // Utilizar la zona horaria de la configuración del sistema
        $config = Config::first();
        $timezone = $config ? $config->time_zone : 'America/Guatemala'; // Valor por defecto si no hay config
        return Carbon::parse($value)->timezone($timezone);
    }

    public function getUpdatedAtAttribute($value): Carbon
    {
        // Utilizar la zona horaria de la configuración del sistema
        $config = Config::first();
        $timezone = $config ? $config->time_zone : 'America/Guatemala'; // Valor por defecto si no hay config
        return Carbon::parse($value)->timezone($timezone);
    }
}
