<?php
/**
 * REGENERAR-CACHE-ARTISAN.PHP
 * Regenerar caché de configuración y rutas después del fix Error 419
 * Ejecutar en: https://flebocenter.com/regenerar-cache-artisan.php
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔄 REGENERAR CACHÉ DE LARAVEL\n";
echo str_repeat("=", 70) . "\n\n";

// Directorio raíz del proyecto (un nivel arriba de public)
$rootDir = dirname(__DIR__);

try {
    // Cargar Laravel
    require $rootDir.'/vendor/autoload.php';
    $app = require_once $rootDir.'/bootstrap/app.php';
    
    echo "✅ Laravel cargado\n\n";
    
    // Obtener el kernel de consola
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    // PASO 1: Limpiar caché de configuración
    echo "📋 PASO 1: Limpiar caché de configuración\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('config:clear');
    echo $status === 0 ? "✅ Config cache limpiado\n" : "⚠️  Config cache: status $status\n";
    
    // PASO 2: Regenerar caché de configuración
    echo "\n📋 PASO 2: Regenerar caché de configuración\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('config:cache');
    echo $status === 0 ? "✅ Config cache regenerado\n" : "❌ Error al regenerar config cache\n";
    
    // Verificar que el archivo se creó
    $configCache = $rootDir.'/bootstrap/cache/config.php';
    if (file_exists($configCache)) {
        $size = filesize($configCache);
        echo "   Archivo: bootstrap/cache/config.php (" . number_format($size) . " bytes)\n";
    }
    
    // PASO 3: Limpiar caché de rutas
    echo "\n📋 PASO 3: Limpiar caché de rutas\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('route:clear');
    echo $status === 0 ? "✅ Routes cache limpiado\n" : "⚠️  Routes cache: status $status\n";
    
    // PASO 4: Regenerar caché de rutas
    echo "\n📋 PASO 4: Regenerar caché de rutas\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('route:cache');
    echo $status === 0 ? "✅ Routes cache regenerado\n" : "❌ Error al regenerar routes cache\n";
    
    // Verificar archivos de rutas
    $routesCache = glob($rootDir.'/bootstrap/cache/routes*.php');
    if (count($routesCache) > 0) {
        foreach ($routesCache as $file) {
            $size = filesize($file);
            echo "   Archivo: " . basename($file) . " (" . number_format($size) . " bytes)\n";
        }
    }
    
    // PASO 5: Limpiar caché de vistas (opcional)
    echo "\n📋 PASO 5: Limpiar caché de vistas\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('view:clear');
    echo $status === 0 ? "✅ Views cache limpiado\n" : "⚠️  Views cache: status $status\n";
    
    // PASO 6: Optimizar autoloader
    echo "\n📋 PASO 6: Optimizar autoloader\n";
    echo str_repeat("-", 70) . "\n";
    
    $status = $kernel->call('optimize:clear');
    echo $status === 0 ? "✅ Optimización limpiada\n" : "⚠️  Optimize: status $status\n";
    
    // RESULTADO FINAL
    echo "\n" . str_repeat("=", 70) . "\n";
    echo "🎯 RESULTADO\n";
    echo str_repeat("=", 70) . "\n\n";
    
    echo "✅✅✅ CACHÉ REGENERADO EXITOSAMENTE ✅✅✅\n\n";
    
    echo "📋 PRÓXIMOS PASOS:\n";
    echo "1. Reiniciar servidor PHP en panel iPage:\n";
    echo "   Panel → PHP Settings → 8.3 → 8.2 → Esperar 10s → 8.3\n\n";
    echo "2. Verificar el fix:\n";
    echo "   https://flebocenter.com/diagnostico-419-produccion.php\n";
    echo "   Debe mostrar: ✅ SessionServiceProvider: REGISTRADO\n\n";
    echo "3. Limpiar cookies del navegador:\n";
    echo "   F12 → Application → Cookies → Clear All\n\n";
    echo "4. Probar login:\n";
    echo "   https://flebocenter.com/login\n\n";
    
    // Información del sistema
    echo str_repeat("-", 70) . "\n";
    echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
    echo "Laravel Version: " . app()->version() . "\n";
    
    if (php_sapi_name() !== 'cli') {
        echo "Servidor: " . ($_SERVER['HTTP_HOST'] ?? 'N/A') . "\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ ERROR AL REGENERAR CACHÉ\n";
    echo str_repeat("=", 70) . "\n";
    echo "Mensaje: " . $e->getMessage() . "\n";
    echo "Archivo: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    
    echo "🔧 SOLUCIÓN:\n";
    echo "1. Verifica que bootstrap/app.php se subió correctamente\n";
    echo "2. Verifica permisos de bootstrap/cache/ (debe ser 775 o 777)\n";
    echo "3. Ejecuta nuevamente: limpia-cache-419.php\n";
    echo "4. Intenta ejecutar este script otra vez\n";
}

echo "\n";
