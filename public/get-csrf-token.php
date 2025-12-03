<?php
/**
 * Generar token CSRF usando el sistema de archivos
 */

header('Content-Type: application/json');
error_reporting(0); // Suprimir warnings para JSON limpio

// Función inline para generar token (sin depender de autoload de Laravel)
function generate_csrf_token_inline() {
    $tokenDir = dirname(__DIR__) . '/storage/framework/csrf_tokens';
    
    // Crear directorio si no existe
    if (!is_dir($tokenDir)) {
        mkdir($tokenDir, 0755, true);
    }
    
    // Hash del cliente (IP + User Agent)
    $clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $clientHash = hash('sha256', $clientIp . $userAgent);
    
    $tokenFile = $tokenDir . '/' . $clientHash . '.token';
    
    // Si existe token válido, devolverlo
    if (file_exists($tokenFile)) {
        $data = json_decode(file_get_contents($tokenFile), true);
        if ($data && isset($data['token']) && isset($data['expires_at'])) {
            if (time() < $data['expires_at']) {
                return $data['token'];
            }
        }
    }
    
    // Generar nuevo token
    $token = bin2hex(random_bytes(20)); // 40 caracteres
    $expiresAt = time() + 3600; // 1 hora
    
    $tokenData = [
        'token' => $token,
        'ip' => $clientIp,
        'expires_at' => $expiresAt,
        'created_at' => time()
    ];
    
    file_put_contents($tokenFile, json_encode($tokenData));
    
    return $token;
}

try {
    $token = generate_csrf_token_inline();
    
    echo json_encode([
        'success' => true,
        'token' => $token,
        'length' => strlen($token),
        'generated_at' => date('Y-m-d H:i:s')
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
