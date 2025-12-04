<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        '*', // TEMPORAL: Deshabilitar cifrado de TODAS las cookies para debug
        // 'app_session', // Cookie de producción (iPage)
        // 'flebocenter_session', // Cookie de local y producción
    ];
}
