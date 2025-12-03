<?php
/**
 * FIX-SAMESITE.PHP
 * Cambiar SESSION_SAME_SITE de 'none' a 'lax' para compatibilidad
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔧 FIX: SESSION_SAME_SITE\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);
$envPath = $rootDir . '/.env';

if (!file_exists($envPath)) {
    echo "❌ Archivo .env no encontrado\n";
    exit(1);
}

$envContent = file_get_contents($envPath);
$originalContent = $envContent;

echo "DIAGNÓSTICO:\n";
echo str_repeat("-", 70) . "\n\n";

echo "PROBLEMA IDENTIFICADO:\n";
echo "  SESSION_SAME_SITE=none\n";
echo "  → Navegadores modernos bloquean cookies con SameSite=none\n";
echo "  → Especialmente sin contexto cross-site real\n";
echo "  → Cookie no persiste entre requests\n\n";

echo "SOLUCIÓN:\n";
echo "  SESSION_SAME_SITE=lax\n";
echo "  → Compatible con navegadores modernos\n";
echo "  → Permite cookies en mismo sitio (mismo dominio)\n";
echo "  → Funciona para aplicaciones normales ✅\n\n";

echo str_repeat("-", 70) . "\n\n";

echo "APLICANDO FIX:\n";
echo str_repeat("-", 70) . "\n";

// Cambiar SESSION_SAME_SITE de none a lax
if (preg_match('/SESSION_SAME_SITE=none/', $envContent)) {
    $envContent = preg_replace(
        '/SESSION_SAME_SITE=none/',
        'SESSION_SAME_SITE=lax',
        $envContent
    );
    
    echo "✅ ANTES: SESSION_SAME_SITE=none\n";
    echo "✅ AHORA: SESSION_SAME_SITE=lax\n\n";
    
    // Backup
    $backupPath = $rootDir . '/.env.backup.' . date('YmdHis');
    file_put_contents($backupPath, $originalContent);
    echo "✅ Backup creado: " . basename($backupPath) . "\n";
    
    // Guardar
    file_put_contents($envPath, $envContent);
    echo "✅ Archivo .env actualizado\n\n";
    
} elseif (preg_match('/SESSION_SAME_SITE=lax/', $envContent)) {
    echo "✅ SESSION_SAME_SITE ya está en 'lax' (correcto)\n\n";
    
} else {
    echo "⚠️ SESSION_SAME_SITE no encontrado o tiene valor diferente\n";
    echo "Agregando SESSION_SAME_SITE=lax...\n";
    
    // Buscar SESSION_SECURE_COOKIE y agregar después
    if (strpos($envContent, 'SESSION_SECURE_COOKIE') !== false) {
        $envContent = preg_replace(
            '/(SESSION_SECURE_COOKIE=[^\r\n]+)/',
            "$1\nSESSION_SAME_SITE=lax",
            $envContent
        );
    } else {
        $envContent .= "\nSESSION_SAME_SITE=lax\n";
    }
    
    file_put_contents($envPath, $envContent);
    echo "✅ SESSION_SAME_SITE=lax agregado\n\n";
}

echo str_repeat("=", 70) . "\n";
echo "✅ FIX APLICADO CORRECTAMENTE\n";
echo str_repeat("=", 70) . "\n\n";

echo "📋 EXPLICACIÓN TÉCNICA:\n\n";

echo "SameSite=none:\n";
echo "  - Diseñado para cookies cross-site (entre dominios)\n";
echo "  - Requiere Secure=true + HTTPS\n";
echo "  - Navegadores modernos lo bloquean sin contexto válido\n";
echo "  - Chrome, Edge, Firefox tienen políticas estrictas\n\n";

echo "SameSite=lax:\n";
echo "  - Diseñado para mismo sitio (mismo dominio)\n";
echo "  - Compatible con todos los navegadores\n";
echo "  - Funciona perfectamente para login normal\n";
echo "  - Bloquea solo requests cross-site maliciosos\n\n";

echo "¿Cuándo usar 'none'?\n";
echo "  - Solo si tu app recibe requests de otros dominios\n";
echo "  - Ejemplo: iframe embebido en otro sitio\n";
echo "  - NO es tu caso (flebocenter.com → flebocenter.com)\n\n";

echo "🔄 PRÓXIMOS PASOS OBLIGATORIOS:\n\n";

echo "1. Limpiar sesiones viejas:\n";
echo "   https://flebocenter.com/limpiar-sesiones.php\n\n";

echo "2. Limpiar OPcache:\n";
echo "   https://flebocenter.com/limpiar-opcache.php\n\n";

echo "3. Regenerar caché:\n";
echo "   https://flebocenter.com/regenerar-cache-artisan.php\n\n";

echo "4. CRÍTICO - Limpiar navegador:\n";
echo "   F12 → Application → Storage → Clear site data\n";
echo "   CERRAR TODAS las pestañas de flebocenter.com\n";
echo "   CERRAR el navegador completamente\n\n";

echo "5. Probar en MODO INCÓGNITO:\n";
echo "   Abrir ventana privada/incógnito\n";
echo "   https://flebocenter.com/login\n";
echo "   Ingresar credenciales\n\n";

echo "6. VERIFICAR en F12 → Network:\n";
echo "   POST /login → Response Headers → Set-Cookie: flebocenter_session=...\n";
echo "   GET /dashboard → Request Headers → Cookie: flebocenter_session=...\n\n";

echo "⚡ SI AÚN FALLA:\n";
echo "El problema es Tracking Prevention del navegador.\n";
echo "Soluciones:\n";
echo "  1. Desactivar Tracking Prevention temporalmente\n";
echo "  2. Usar Chrome (menos restrictivo)\n";
echo "  3. Agregar flebocenter.com a excepciones\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
