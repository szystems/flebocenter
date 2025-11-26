<?php

namespace App\Helpers;

/**
 * CSRF Helper basado en archivos
 * Solución para Error 419 en hosting iPage sin sesiones PHP funcionales
 */
class CsrfFileHelper
{
    /**
     * Generar token CSRF basado en archivos
     * 
     * @return string Token CSRF
     */
    public static function csrf_token_file()
    {
        $token_dir = storage_path('framework/csrf_tokens');
        
        // Crear directorio si no existe
        if (!is_dir($token_dir)) {
            mkdir($token_dir, 0755, true);
        }
        
        // Generar hash único del cliente (más estable, solo IP + navegador base)
        $client_hash = self::getClientHash();
        $filename = $token_dir . '/' . $client_hash . '.token';
        
        // Si existe un token válido, devolverlo
        if (file_exists($filename)) {
            $data = json_decode(file_get_contents($filename), true);
            if ($data && isset($data['expires']) && $data['expires'] > time()) {
                return $data['token'];
            }
            // Si expiró, eliminar archivo
            unlink($filename);
        }
        
        // Generar nuevo token
        $token = bin2hex(random_bytes(20));
        $data = json_encode([
            'token' => $token,
            'timestamp' => time(),
            'expires' => time() + 3600, // 1 hora
            'client_ip' => request()->ip(),
            'user_agent_hash' => hash('sha256', request()->userAgent())
        ]);
        
        file_put_contents($filename, $data);
        
        return $token;
    }
    
    /**
     * Generar hash estable del cliente
     * 
     * @return string Hash del cliente
     */
    public static function getClientHash()
    {
        $ip = request()->ip();
        
        // Para desarrollo local, usar solo IP (más estable)
        // Para producción, se puede agregar más contexto
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return hash('sha256', 'local_dev_' . $ip);
        }
        
        // Para IPs reales, usar IP + navegador básico
        $userAgent = request()->userAgent();
        $browserBasic = '';
        
        if (strpos($userAgent, 'Chrome') !== false) $browserBasic = 'chrome';
        elseif (strpos($userAgent, 'Firefox') !== false) $browserBasic = 'firefox'; 
        elseif (strpos($userAgent, 'Safari') !== false) $browserBasic = 'safari';
        elseif (strpos($userAgent, 'Edge') !== false) $browserBasic = 'edge';
        else $browserBasic = 'other';
        
        return hash('sha256', $ip . '_' . $browserBasic);
    }
    
    /**
     * Validar token CSRF basado en archivos
     * 
     * @param string $token Token a validar
     * @return bool True si el token es válido
     */
    public static function validate_csrf_file($token)
    {
        if (empty($token)) {
            return false;
        }
        
        $token_dir = storage_path('framework/csrf_tokens');
        $client_hash = self::getClientHash();
        $filename = $token_dir . '/' . $client_hash . '.token';
        
        if (!file_exists($filename)) {
            return false;
        }
        
        $data = json_decode(file_get_contents($filename), true);
        
        if (!$data || !isset($data['token']) || !isset($data['expires'])) {
            return false;
        }
        
        // Verificar que no haya expirado
        if ($data['expires'] <= time()) {
            unlink($filename);
            return false;
        }
        
        // Validar token usando hash_equals para seguridad
        return hash_equals($data['token'], $token);
    }
    
    /**
     * Limpiar tokens expirados
     * 
     * @return int Número de tokens eliminados
     */
    public static function cleanup_expired_tokens()
    {
        $token_dir = storage_path('framework/csrf_tokens');
        
        if (!is_dir($token_dir)) {
            return 0;
        }
        
        $files = glob($token_dir . '/*.token');
        $deleted = 0;
        
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            
            if (!$data || !isset($data['expires']) || $data['expires'] <= time()) {
                unlink($file);
                $deleted++;
            }
        }
        
        return $deleted;
    }
    
    /**
     * Obtener información de debug del sistema
     * 
     * @return array Información de debug
     */
    public static function debug_info()
    {
        $token_dir = storage_path('framework/csrf_tokens');
        $client_hash = self::getClientHash();
        
        return [
            'token_dir' => $token_dir,
            'token_dir_exists' => is_dir($token_dir),
            'token_dir_writable' => is_writable($token_dir),
            'client_hash' => $client_hash,
            'client_ip' => request()->ip(),
            'user_agent' => substr(request()->userAgent(), 0, 100),
            'token_file_exists' => file_exists($token_dir . '/' . $client_hash . '.token'),
            'total_tokens' => count(glob($token_dir . '/*.token')),
        ];
    }
}