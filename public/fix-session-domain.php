<?php
/**
 * FIX-SESSION-DOMAIN.PHP
 * Cambiar SESSION_DOMAIN para que funcione correctamente
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔧 FIX: SESSION_DOMAIN\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);
$envPath = $rootDir . '/.env';

if (!file_exists($envPath)) {
    echo "❌ Archivo .env no encontrado\n";
    exit(1);
}

$envContent = file_get_contents($envPath);
$originalContent = $envContent;

echo "CAMBIO CRÍTICO:\n";
echo str_repeat("-", 70) . "\n\n";

// Cambiar SESSION_DOMAIN de .flebocenter.com a flebocenter.com (sin punto)
if (preg_match('/SESSION_DOMAIN=\.flebocenter\.com/', $envContent)) {
    $envContent = preg_replace(
        '/SESSION_DOMAIN=\.flebocenter\.com/',
        'SESSION_DOMAIN=flebocenter.com',
        $envContent
    );
    
    echo "✅ ANTES: SESSION_DOMAIN=.flebocenter.com\n";
    echo "✅ AHORA: SESSION_DOMAIN=flebocenter.com\n\n";
    
    // Backup
    $backupPath = $rootDir . '/.env.backup.' . date('YmdHis');
    file_put_contents($backupPath, $originalContent);
    echo "✅ Backup creado: " . basename($backupPath) . "\n";
    
    // Guardar
    file_put_contents($envPath, $envContent);
    echo "✅ Archivo .env actualizado\n\n";
    
} elseif (preg_match('/SESSION_DOMAIN=flebocenter\.com/', $envContent)) {
    echo "✅ SESSION_DOMAIN ya está correcto (sin punto inicial)\n\n";
    
} elseif (preg_match('/SESSION_DOMAIN=null/', $envContent)) {
    // Cambiar de null a flebocenter.com
    $envContent = preg_replace(
        '/SESSION_DOMAIN=null/',
        'SESSION_DOMAIN=flebocenter.com',
        $envContent
    );
    
    echo "✅ ANTES: SESSION_DOMAIN=null\n";
    echo "✅ AHORA: SESSION_DOMAIN=flebocenter.com\n\n";
    
    file_put_contents($envPath, $envContent);
    echo "✅ Archivo .env actualizado\n\n";
    
} else {
    echo "⚠️ SESSION_DOMAIN no encontrado o tiene valor inesperado\n";
    
    // Agregar si no existe
    $envContent .= "\nSESSION_DOMAIN=flebocenter.com\n";
    file_put_contents($envPath, $envContent);
    echo "✅ SESSION_DOMAIN agregado\n\n";
}

echo str_repeat("=", 70) . "\n";
echo "✅ FIX APLICADO\n";
echo str_repeat("=", 70) . "\n\n";

echo "📋 EXPLICACIÓN:\n\n";
echo "PROBLEMA:\n";
echo "  SESSION_DOMAIN=.flebocenter.com (con punto)\n";
echo "  → Algunos navegadores rechazan cookies con punto inicial\n";
echo "  → Cookie no se envía de vuelta al navegador\n";
echo "  → Nueva sesión guest en cada request\n\n";

echo "SOLUCIÓN:\n";
echo "  SESSION_DOMAIN=flebocenter.com (sin punto)\n";
echo "  → Cookie funciona correctamente\n";
echo "  → Sesión persiste entre requests\n";
echo "  → Login exitoso ✅\n\n";

echo "🔄 PRÓXIMOS PASOS:\n\n";
echo "1. Limpiar OPcache:\n";
echo "   https://flebocenter.com/limpiar-opcache.php\n\n";

echo "2. Regenerar caché:\n";
echo "   https://flebocenter.com/regenerar-cache-artisan.php\n\n";

echo "3. IMPORTANTE - Eliminar sesiones viejas en MySQL:\n";
echo "   MySQL → Ejecuta: TRUNCATE TABLE sessions;\n";
echo "   Esto elimina todas las sesiones ghost con user_id=NULL\n\n";

echo "4. Limpiar cookies del navegador:\n";
echo "   F12 → Application → Cookies → Eliminar todas\n";
echo "   Cerrar TODAS las pestañas de flebocenter.com\n\n";

echo "5. Probar login en pestaña nueva:\n";
echo "   Nueva pestaña → https://flebocenter.com/login\n\n";

echo "⚡ NOTA IMPORTANTE:\n";
echo "Las sesiones viejas en MySQL están causando conflicto.\n";
echo "Hay " . count(file($envPath)) . " líneas en .env\n";
echo "Ejecuta TRUNCATE TABLE sessions; para limpiar todo.\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
