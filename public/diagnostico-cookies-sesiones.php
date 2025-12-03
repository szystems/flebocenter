<?php
/**
 * DIAGNÓSTICO COMPLETO - COOKIES Y SESIONES
 * Verificar por qué la sesión no persiste después del login
 */

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Diagnóstico Cookies y Sesiones</title>
    <style>
        body { font-family: monospace; margin: 20px; background: #1e1e1e; color: #d4d4d4; }
        .section { background: #252526; padding: 15px; margin: 10px 0; border-left: 3px solid #007acc; }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .warning { color: #dcdcaa; }
        h2 { color: #569cd6; margin-top: 0; }
        pre { background: #1e1e1e; padding: 10px; overflow-x: auto; }
        .info { color: #9cdcfe; }
        button { background: #007acc; color: white; border: none; padding: 10px 20px; cursor: pointer; margin: 5px; }
        button:hover { background: #005a9e; }
        #cookieTest { margin-top: 20px; padding: 15px; background: #2d2d30; }
    </style>
</head>
<body>
    <h1>🔍 DIAGNÓSTICO COMPLETO - COOKIES Y SESIONES</h1>

<?php
$rootDir = dirname(__DIR__);
require $rootDir . '/vendor/autoload.php';

$app = require_once $rootDir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "<div class='section'>";
echo "<h2>TEST 1: Configuración de Sesión</h2>";
echo "<pre>";

$sessionConfig = config('session');
echo "<span class='info'>Driver:</span> " . $sessionConfig['driver'] . "\n";
echo "<span class='info'>Lifetime:</span> " . $sessionConfig['lifetime'] . " minutos\n";
echo "<span class='info'>Cookie Name:</span> " . $sessionConfig['cookie'] . "\n";
echo "<span class='info'>Domain:</span> " . ($sessionConfig['domain'] ?? 'null') . "\n";
echo "<span class='info'>Path:</span> " . $sessionConfig['path'] . "\n";
echo "<span class='info'>Secure:</span> " . ($sessionConfig['secure'] ? 'true' : 'false') . "\n";
echo "<span class='info'>HttpOnly:</span> " . ($sessionConfig['http_only'] ? 'true' : 'false') . "\n";
echo "<span class='info'>SameSite:</span> " . ($sessionConfig['same_site'] ?? 'null') . "\n";

// Verificaciones
if ($sessionConfig['driver'] === 'database') {
    echo "<span class='success'>✅ Driver en database (correcto)</span>\n";
} else {
    echo "<span class='error'>❌ Driver NO está en database: " . $sessionConfig['driver'] . "</span>\n";
}

if ($sessionConfig['secure'] === true) {
    echo "<span class='success'>✅ Secure cookie habilitado (HTTPS)</span>\n";
} else {
    echo "<span class='warning'>⚠️ Secure cookie deshabilitado</span>\n";
}

if ($sessionConfig['same_site'] === 'none') {
    echo "<span class='success'>✅ SameSite=none (permite cookies cross-site)</span>\n";
} else {
    echo "<span class='warning'>⚠️ SameSite=" . $sessionConfig['same_site'] . " (puede bloquear cookies)</span>\n";
}

echo "</pre></div>";

// TEST 2: Base de datos
echo "<div class='section'>";
echo "<h2>TEST 2: Tabla de Sesiones en Database</h2>";
echo "<pre>";

try {
    $db = DB::connection();
    $dbName = $db->getDatabaseName();
    echo "<span class='success'>✅ Conectado a: $dbName</span>\n\n";
    
    $exists = DB::select("SHOW TABLES LIKE 'sessions'");
    
    if (!empty($exists)) {
        echo "<span class='success'>✅ Tabla 'sessions' existe</span>\n\n";
        
        $count = DB::table('sessions')->count();
        echo "<span class='info'>Sesiones activas:</span> $count\n\n";
        
        if ($count > 0) {
            echo "<span class='info'>Últimas 5 sesiones:</span>\n";
            $sessions = DB::table('sessions')
                ->orderBy('last_activity', 'desc')
                ->limit(5)
                ->get(['id', 'user_id', 'ip_address', 'last_activity']);
            
            foreach ($sessions as $session) {
                $lastActivity = date('Y-m-d H:i:s', $session->last_activity);
                $userId = $session->user_id ?? 'guest';
                echo "  - ID: " . substr($session->id, 0, 20) . "... | User: $userId | IP: {$session->ip_address} | Actividad: $lastActivity\n";
            }
        }
    } else {
        echo "<span class='error'>❌ Tabla 'sessions' NO existe</span>\n";
        echo "<span class='warning'>Ejecuta: migrar-sesiones-database.php</span>\n";
    }
    
} catch (Exception $e) {
    echo "<span class='error'>❌ Error: " . $e->getMessage() . "</span>\n";
}

echo "</pre></div>";

// TEST 3: Cookies del Request actual
echo "<div class='section'>";
echo "<h2>TEST 3: Cookies Recibidas en Request</h2>";
echo "<pre>";

$cookies = $request->cookies->all();

if (empty($cookies)) {
    echo "<span class='error'>❌ NO se recibieron cookies</span>\n";
    echo "<span class='warning'>Posibles causas:</span>\n";
    echo "  1. Navegador bloqueando cookies (Tracking Prevention)\n";
    echo "  2. Configuración SameSite incompatible\n";
    echo "  3. Dominio de cookie no coincide\n";
} else {
    echo "<span class='success'>✅ Cookies recibidas: " . count($cookies) . "</span>\n\n";
    
    $sessionCookieName = $sessionConfig['cookie'];
    
    foreach ($cookies as $name => $value) {
        $truncated = strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;
        echo "<span class='info'>$name:</span> $truncated\n";
        
        if ($name === $sessionCookieName) {
            echo "<span class='success'>  ✅ Cookie de sesión ENCONTRADA</span>\n";
        }
    }
    
    if (!isset($cookies[$sessionCookieName])) {
        echo "\n<span class='error'>❌ Cookie de sesión '$sessionCookieName' NO encontrada</span>\n";
    }
}

echo "</pre></div>";

// TEST 4: Headers HTTP
echo "<div class='section'>";
echo "<h2>TEST 4: Headers HTTP y Seguridad</h2>";
echo "<pre>";

echo "<span class='info'>Request URL:</span> " . $request->url() . "\n";
echo "<span class='info'>Request Method:</span> " . $request->method() . "\n";
echo "<span class='info'>HTTPS:</span> " . ($request->secure() ? 'true' : 'false') . "\n";
echo "<span class='info'>User Agent:</span> " . substr($request->userAgent(), 0, 100) . "...\n";
echo "<span class='info'>IP Address:</span> " . $request->ip() . "\n";

if ($request->secure()) {
    echo "<span class='success'>✅ Conexión HTTPS segura</span>\n";
} else {
    echo "<span class='error'>❌ Conexión NO segura (HTTP)</span>\n";
    echo "<span class='warning'>SESSION_SECURE_COOKIE debería ser false si no hay HTTPS</span>\n";
}

echo "</pre></div>";

// TEST 5: Test de Cookie JavaScript
echo "<div class='section'>";
echo "<h2>TEST 5: Prueba de Cookies JavaScript (Cliente)</h2>";
echo "<div id='cookieTest'>";
echo "<p>Ejecutando pruebas en el navegador...</p>";
echo "</div>";
echo "</div>";

?>

<div class='section'>
    <h2>🎯 ACCIONES CORRECTIVAS</h2>
    <pre>
<?php

$issues = [];
$fixes = [];

// Verificar driver
if ($sessionConfig['driver'] !== 'database') {
    $issues[] = "SESSION_DRIVER no está en 'database'";
    $fixes[] = "1. Edita .env y cambia SESSION_DRIVER=database";
    $fixes[] = "2. Ejecuta: limpiar-opcache.php";
}

// Verificar tabla
if (empty($exists)) {
    $issues[] = "Tabla 'sessions' no existe";
    $fixes[] = "3. Ejecuta: migrar-sesiones-database.php";
}

// Verificar HTTPS vs Secure
if ($request->secure() && $sessionConfig['secure'] !== true) {
    $issues[] = "HTTPS activo pero SESSION_SECURE_COOKIE no está en true";
    $fixes[] = "4. En .env: SESSION_SECURE_COOKIE=true";
}

if (!$request->secure() && $sessionConfig['secure'] === true) {
    $issues[] = "SESSION_SECURE_COOKIE=true pero conexión es HTTP";
    $fixes[] = "4. En .env: SESSION_SECURE_COOKIE=false (o usa HTTPS)";
}

// Verificar SameSite
if ($sessionConfig['same_site'] === 'lax') {
    $issues[] = "SameSite=lax puede causar problemas con Tracking Prevention";
    $fixes[] = "5. En .env: SESSION_SAME_SITE=none";
    $fixes[] = "6. En config/session.php línea 199: 'same_site' => env('SESSION_SAME_SITE', 'lax'),";
}

// Verificar cookies
if (empty($cookies)) {
    $issues[] = "No se reciben cookies del navegador";
    $fixes[] = "7. Limpia cookies: F12 → Application → Cookies → Clear";
    $fixes[] = "8. Desactiva Tracking Prevention temporalmente";
    $fixes[] = "9. Prueba en modo incógnito/privado";
}

if (empty($issues)) {
    echo "<span class='success'>✅✅✅ NO SE DETECTARON PROBLEMAS ✅✅✅</span>\n\n";
    echo "La configuración parece correcta.\n";
    echo "Si el login aún falla, revisa los logs del navegador (F12 → Console).\n";
} else {
    echo "<span class='error'>❌ PROBLEMAS DETECTADOS:</span>\n\n";
    foreach ($issues as $i => $issue) {
        echo ($i + 1) . ". $issue\n";
    }
    
    echo "\n<span class='warning'>🔧 SOLUCIONES:</span>\n\n";
    foreach ($fixes as $fix) {
        echo "$fix\n";
    }
}

?>
    </pre>
</div>

<div class='section'>
    <h2>🔄 ACCIONES RÁPIDAS</h2>
    <button onclick="clearLocalCookies()">Limpiar Cookies Locales</button>
    <button onclick="testCookieWrite()">Probar Escritura de Cookie</button>
    <button onclick="location.reload()">Recargar Diagnóstico</button>
    <button onclick="window.open('/login', '_blank')">Abrir Login</button>
</div>

<script>
// Test de cookies JavaScript
window.addEventListener('DOMContentLoaded', function() {
    const testDiv = document.getElementById('cookieTest');
    let results = '';
    
    // Test 1: Leer cookies
    results += '📋 Cookies disponibles en JavaScript:\n';
    if (document.cookie) {
        const cookies = document.cookie.split(';');
        results += `  ✅ ${cookies.length} cookie(s) encontradas\n`;
        cookies.forEach(c => {
            results += `    - ${c.trim().split('=')[0]}\n`;
        });
    } else {
        results += '  ❌ No hay cookies disponibles\n';
        results += '  Causa probable: httpOnly=true o Tracking Prevention\n';
    }
    
    // Test 2: Intentar escribir cookie
    results += '\n🔐 Intentando escribir cookie de prueba:\n';
    try {
        document.cookie = 'test_cookie=123; path=/; SameSite=None; Secure';
        
        // Verificar si se escribió
        if (document.cookie.includes('test_cookie')) {
            results += '  ✅ Cookie de prueba escrita exitosamente\n';
        } else {
            results += '  ❌ No se pudo escribir cookie\n';
            results += '  Navegador bloqueando cookies\n';
        }
    } catch(e) {
        results += '  ❌ Error: ' + e.message + '\n';
    }
    
    // Test 3: Storage disponible
    results += '\n💾 Almacenamiento del navegador:\n';
    try {
        localStorage.setItem('test', '1');
        localStorage.removeItem('test');
        results += '  ✅ localStorage: disponible\n';
    } catch(e) {
        results += '  ❌ localStorage: bloqueado\n';
    }
    
    try {
        sessionStorage.setItem('test', '1');
        sessionStorage.removeItem('test');
        results += '  ✅ sessionStorage: disponible\n';
    } catch(e) {
        results += '  ❌ sessionStorage: bloqueado\n';
    }
    
    // Test 4: Tracking Prevention
    results += '\n🛡️ Protección de Navegador:\n';
    if (navigator.doNotTrack === '1') {
        results += '  ⚠️ Do Not Track: HABILITADO\n';
    }
    
    // Mostrar resultados
    testDiv.innerHTML = '<pre>' + results + '</pre>';
});

function clearLocalCookies() {
    const cookies = document.cookie.split(';');
    cookies.forEach(cookie => {
        const name = cookie.split('=')[0].trim();
        document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
    });
    alert('Cookies locales limpiadas. Recarga la página.');
}

function testCookieWrite() {
    document.cookie = 'test_manual=456; path=/; SameSite=None; Secure';
    setTimeout(() => {
        if (document.cookie.includes('test_manual')) {
            alert('✅ Cookie escrita exitosamente');
        } else {
            alert('❌ No se pudo escribir cookie. Navegador bloqueando.');
        }
    }, 100);
}
</script>

<div class='section'>
    <p><strong>Ejecutado:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
</div>

</body>
</html>
