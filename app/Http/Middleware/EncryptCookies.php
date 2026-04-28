<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        // Las cookies de sesión DEBEN ser cifradas/descifradas por Laravel
        // NO excluir flebocenter_session ni app_session
    ];
}
