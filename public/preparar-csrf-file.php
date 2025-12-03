<?php
/**
 * PREPARAR SISTEMA CSRF FILE
 * Crear estructura necesaria para CSRF basado en archivos
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔧 PREPARAR SISTEMA CSRF FILE\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);
$tokenDir = $rootDir . '/storage/framework/csrf_tokens';

echo "PASO 1: Crear directorio de tokens\n";
echo str_repeat("-", 70) . "\n";

if (is_dir($tokenDir)) {
    echo "✅ Directorio ya existe: $tokenDir\n";
} else {
    if (mkdir($tokenDir, 0755, true)) {
        echo "✅ Directorio creado: $tokenDir\n";
    } else {
        echo "❌ Error al crear directorio: $tokenDir\n";
        exit(1);
    }
}

echo "\nPASO 2: Verificar permisos\n";
echo str_repeat("-", 70) . "\n";

if (is_writable($tokenDir)) {
    echo "✅ Directorio tiene permisos de escritura\n";
} else {
    echo "⚠️ Intentando dar permisos...\n";
    if (chmod($tokenDir, 0755)) {
        echo "✅ Permisos actualizados\n";
    } else {
        echo "❌ No se pudieron actualizar permisos\n";
        echo "   Ejecuta manualmente: chmod 755 $tokenDir\n";
    }
}

echo "\nPASO 3: Crear archivo .gitignore\n";
echo str_repeat("-", 70) . "\n";

$gitignore = $tokenDir . '/.gitignore';
file_put_contents($gitignore, "*.token\n!.gitignore\n");
echo "✅ .gitignore creado (tokens no se subirán a git)\n";

echo "\nPASO 4: Limpiar tokens viejos si existen\n";
echo str_repeat("-", 70) . "\n";

$tokens = glob($tokenDir . '/*.token');
if (count($tokens) > 0) {
    foreach ($tokens as $token) {
        unlink($token);
    }
    echo "🧹 " . count($tokens) . " tokens viejos eliminados\n";
} else {
    echo "✅ No hay tokens viejos\n";
}

echo "\n";
echo str_repeat("=", 70) . "\n";
echo "✅✅✅ SISTEMA PREPARADO CORRECTAMENTE ✅✅✅\n";
echo str_repeat("=", 70) . "\n\n";

echo "📋 PRÓXIMOS PASOS:\n\n";
echo "1. Ejecuta: https://flebocenter.com/diagnostico-csrf-file.php\n";
echo "   Para verificar que todo funciona\n\n";
echo "2. Si el diagnóstico pasa, ejecuta:\n";
echo "   https://flebocenter.com/limpiar-opcache.php\n\n";
echo "3. Luego ejecuta:\n";
echo "   https://flebocenter.com/regenerar-cache-artisan.php\n\n";
echo "4. Limpia cookies del navegador\n\n";
echo "5. Prueba el login\n\n";

echo "⚠️ IMPORTANTE:\n";
echo "Este sistema NO usa sesiones PHP, usa archivos.\n";
echo "Es más estable para hosting compartido como iPage.\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
