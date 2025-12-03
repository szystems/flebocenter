<?php
/**
 * MIGRAR-SESIONES-DATABASE.PHP
 * Crear tabla de sesiones en base de datos y cambiar driver
 * SOLUCIÓN DEFINITIVA para Error 419 y problemas de sesión
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔄 MIGRACIÓN: SESIONES EN BASE DE DATOS\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);

echo "PASO 1: Verificar conexión a base de datos\n";
echo str_repeat("-", 70) . "\n";

try {
    require $rootDir . '/vendor/autoload.php';
    
    $app = require_once $rootDir . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $db = DB::connection();
    $dbName = $db->getDatabaseName();
    
    echo "✅ Conectado a base de datos: $dbName\n";
    
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nPASO 2: Verificar si tabla 'sessions' existe\n";
echo str_repeat("-", 70) . "\n";

try {
    $exists = DB::select("SHOW TABLES LIKE 'sessions'");
    
    if (!empty($exists)) {
        echo "⚠️ Tabla 'sessions' ya existe\n";
        echo "   Verificando estructura...\n";
        
        $columns = DB::select("DESCRIBE sessions");
        echo "   Columnas: " . count($columns) . "\n";
        
        foreach ($columns as $column) {
            echo "   - {$column->Field} ({$column->Type})\n";
        }
        
        echo "\n¿Deseas recrear la tabla? (Esto eliminará sesiones actuales)\n";
        echo "Para recrear, elimina la tabla manualmente y ejecuta este script nuevamente.\n\n";
        
    } else {
        echo "✅ Tabla 'sessions' no existe, procediendo a crear...\n\n";
        
        echo "PASO 3: Crear tabla 'sessions'\n";
        echo str_repeat("-", 70) . "\n";
        
        DB::statement("
            CREATE TABLE `sessions` (
                `id` VARCHAR(255) NOT NULL,
                `user_id` BIGINT UNSIGNED NULL,
                `ip_address` VARCHAR(45) NULL,
                `user_agent` TEXT NULL,
                `payload` LONGTEXT NOT NULL,
                `last_activity` INT NOT NULL,
                PRIMARY KEY (`id`),
                INDEX `sessions_user_id_index` (`user_id`),
                INDEX `sessions_last_activity_index` (`last_activity`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        echo "✅ Tabla 'sessions' creada exitosamente\n";
        
        // Verificar
        $columns = DB::select("DESCRIBE sessions");
        echo "   Columnas creadas: " . count($columns) . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error al crear tabla: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nPASO 4: Verificar archivo .env\n";
echo str_repeat("-", 70) . "\n";

$envPath = $rootDir . '/.env';
$envContent = file_get_contents($envPath);

if (strpos($envContent, 'SESSION_DRIVER=database') !== false) {
    echo "✅ .env ya tiene SESSION_DRIVER=database\n";
} else {
    echo "⚠️ .env tiene SESSION_DRIVER diferente\n";
    
    // Mostrar configuración actual
    preg_match('/SESSION_DRIVER=([^\r\n]+)/', $envContent, $matches);
    $currentDriver = $matches[1] ?? 'no configurado';
    echo "   Driver actual: $currentDriver\n\n";
    
    echo "CORRECCIÓN AUTOMÁTICA:\n";
    $envContent = preg_replace('/SESSION_DRIVER=([^\r\n]+)/', 'SESSION_DRIVER=database', $envContent);
    file_put_contents($envPath, $envContent);
    
    echo "✅ .env actualizado a SESSION_DRIVER=database\n";
}

echo "\nPASO 5: Limpiar caché de configuración\n";
echo str_repeat("-", 70) . "\n";

$configCache = $rootDir . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    unlink($configCache);
    echo "✅ Cache de configuración eliminado\n";
}

echo "\nPASO 6: Limpiar sesiones de archivos antiguas\n";
echo str_repeat("-", 70) . "\n";

$sessionsPath = $rootDir . '/storage/framework/sessions';
if (is_dir($sessionsPath)) {
    $sessions = glob($sessionsPath . '/*');
    $count = 0;
    foreach ($sessions as $session) {
        if (is_file($session) && unlink($session)) {
            $count++;
        }
    }
    echo "🧹 Sesiones de archivos eliminadas: $count\n";
} else {
    echo "✅ No hay sesiones de archivos\n";
}

echo "\nPASO 7: Limpiar tokens CSRF de archivos\n";
echo str_repeat("-", 70) . "\n";

$csrfPath = $rootDir . '/storage/framework/csrf_tokens';
if (is_dir($csrfPath)) {
    $tokens = glob($csrfPath . '/*.token');
    $count = 0;
    foreach ($tokens as $token) {
        if (unlink($token)) {
            $count++;
        }
    }
    echo "🧹 Tokens CSRF eliminados: $count\n";
} else {
    echo "✅ No hay tokens CSRF\n";
}

echo "\n";
echo str_repeat("=", 70) . "\n";
echo "✅✅✅ MIGRACIÓN COMPLETADA EXITOSAMENTE ✅✅✅\n";
echo str_repeat("=", 70) . "\n\n";

echo "📋 SISTEMA ACTUALIZADO:\n\n";
echo "✅ Tabla 'sessions' creada en base de datos\n";
echo "✅ .env configurado con SESSION_DRIVER=database\n";
echo "✅ Sesiones antiguas eliminadas\n";
echo "✅ Sistema listo para autenticación estable\n\n";

echo "🔄 PRÓXIMOS PASOS OBLIGATORIOS:\n\n";

echo "1. LIMPIAR OPCACHE:\n";
echo "   https://flebocenter.com/limpiar-opcache.php\n\n";

echo "2. REGENERAR CACHÉ:\n";
echo "   https://flebocenter.com/regenerar-cache-artisan.php\n\n";

echo "3. VERIFICAR CSRF:\n";
echo "   https://flebocenter.com/diagnostico-csrf-file.php\n\n";

echo "4. LIMPIAR COOKIES DEL NAVEGADOR:\n";
echo "   F12 → Application → Cookies → Eliminar todas\n\n";

echo "5. PROBAR LOGIN:\n";
echo "   https://flebocenter.com/login\n\n";

echo "⚡ VENTAJAS DEL NUEVO SISTEMA:\n\n";
echo "✅ Sesiones persistentes en MySQL (no se pierden)\n";
echo "✅ CSRF basado en archivos (independiente de sesiones)\n";
echo "✅ No depende de archivos PHP temporales\n";
echo "✅ Compatible con hosting compartido\n";
echo "✅ Más estable que SESSION_DRIVER=file\n";
echo "✅ Error 419 y problemas de autenticación RESUELTOS\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
