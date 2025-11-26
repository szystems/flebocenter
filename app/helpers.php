<?php

/**
 * Helpers globales para FleboCenter
 * Sistema CSRF basado en archivos para iPage hosting
 */

use App\Helpers\CsrfFileHelper;

if (!function_exists('csrf_token_file')) {
    /**
     * Generar token CSRF basado en archivos
     * 
     * @return string
     */
    function csrf_token_file()
    {
        return CsrfFileHelper::csrf_token_file();
    }
}

if (!function_exists('csrf_field_file')) {
    /**
     * Generar campo CSRF para formularios
     * 
     * @return \Illuminate\Support\HtmlString
     */
    function csrf_field_file()
    {
        return new \Illuminate\Support\HtmlString('<input type="hidden" name="_token" value="'.csrf_token_file().'">');
    }
}

if (!function_exists('validate_csrf_file')) {
    /**
     * Validar token CSRF basado en archivos
     * 
     * @param string $token
     * @return bool
     */
    function validate_csrf_file($token)
    {
        return CsrfFileHelper::validate_csrf_file($token);
    }
}

if (!function_exists('csrf_debug_info')) {
    /**
     * Obtener información de debug del sistema CSRF
     * 
     * @return array
     */
    function csrf_debug_info()
    {
        return CsrfFileHelper::debug_info();
    }
}