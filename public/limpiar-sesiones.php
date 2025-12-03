<?php
/**
 * LIMPIAR-SESIONES.PHP
 * Eliminar todas las sesiones viejas de la tabla sessions
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🧹 LIMPIAR SESIONES DE BASE DE DATOS\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);
require $rootDir . '/vendor/autoload.php';

$app = require_once $rootDir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "PASO 1: Verificar conexión a base de datos\n";
echo str_repeat("-", 70) . "\n";

try {
    $db = DB::connection();
    $dbName = $db->getDatabaseName();
    echo "✅ Conectado a: $dbName\n\n";
    
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}

echo "PASO 2: Contar sesiones actuales\n";
echo str_repeat("-", 70) . "\n";

try {
    $totalSessions = DB::table('sessions')->count();
    echo "📊 Sesiones totales: $totalSessions\n\n";
    
    if ($totalSessions > 0) {
        // Contar por tipo
        $guestSessions = DB::table('sessions')->whereNull('user_id')->count();
        $authSessions = DB::table('sessions')->whereNotNull('user_id')->count();
        
        echo "   👤 Sesiones autenticadas (user_id): $authSessions\n";
        echo "   👻 Sesiones guest (sin user_id): $guestSessions\n\n";
        
        // Mostrar últimas sesiones autenticadas
        if ($authSessions > 0) {
            echo "   Últimas sesiones autenticadas:\n";
            $authList = DB::table('sessions')
                ->whereNotNull('user_id')
                ->orderBy('last_activity', 'desc')
                ->limit(5)
                ->get(['id', 'user_id', 'ip_address', 'last_activity']);
            
            foreach ($authList as $session) {
                $time = date('Y-m-d H:i:s', $session->last_activity);
                echo "   - User {$session->user_id} | IP: {$session->ip_address} | $time\n";
            }
            echo "\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "PASO 3: Eliminar TODAS las sesiones\n";
echo str_repeat("-", 70) . "\n";

try {
    // TRUNCATE TABLE sessions
    DB::statement('TRUNCATE TABLE sessions');
    
    echo "✅ TODAS las sesiones eliminadas\n\n";
    
    // Verificar
    $remaining = DB::table('sessions')->count();
    echo "📊 Sesiones restantes: $remaining\n";
    
    if ($remaining === 0) {
        echo "✅ Tabla sessions limpia completamente\n";
    } else {
        echo "⚠️ Aún quedan $remaining sesiones\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error al limpiar: " . $e->getMessage() . "\n";
    
    // Intentar con DELETE si TRUNCATE falla
    echo "\nIntentando con DELETE...\n";
    try {
        $deleted = DB::table('sessions')->delete();
        echo "✅ $deleted sesiones eliminadas con DELETE\n";
    } catch (Exception $e2) {
        echo "❌ Error con DELETE: " . $e2->getMessage() . "\n";
        exit(1);
    }
}

echo "\n";
echo str_repeat("=", 70) . "\n";
echo "✅✅✅ LIMPIEZA COMPLETADA ✅✅✅\n";
echo str_repeat("=", 70) . "\n\n";

echo "📋 RESULTADO:\n\n";
echo "✅ Sesiones eliminadas: $totalSessions\n";
echo "✅ Tabla sessions limpia\n";
echo "✅ Lista para nuevas sesiones\n\n";

echo "🔄 PRÓXIMOS PASOS:\n\n";
echo "1. Ejecutar: limpiar-opcache.php\n";
echo "2. Ejecutar: regenerar-cache-artisan.php\n";
echo "3. Limpiar cookies del navegador (F12 → Application → Clear site data)\n";
echo "4. CERRAR TODAS las pestañas de flebocenter.com\n";
echo "5. Abrir nueva pestaña → https://flebocenter.com/login\n";
echo "6. Probar login con credenciales\n\n";

echo "⚡ IMPORTANTE:\n";
echo "Si el login sigue fallando después de esto:\n";
echo "- Usa modo incógnito/privado del navegador\n";
echo "- Verifica que SESSION_DOMAIN=flebocenter.com (sin punto)\n";
echo "- Ejecuta: diagnostico-cookies-sesiones.php\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
