<?php
/**
 * DIAGNÓSTICO CSRF PARA iPAGE - FLEBOCENTER V2
 * Versión simplificada y más robusta
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función helper para mostrar secciones
function showSection($title, $content, $type = 'info') {
    $colors = [
        'success' => ['bg' => '#d4edda', 'border' => '#28a745', 'color' => '#155724'],
        'error' => ['bg' => '#f8d7da', 'border' => '#dc3545', 'color' => '#721c24'],
        'warning' => ['bg' => '#fff3cd', 'border' => '#ffc107', 'color' => '#856404'],
        'info' => ['bg' => '#cce7ff', 'border' => '#007bff', 'color' => '#004085'],
    ];
    
    $c = $colors[$type] ?? $colors['info'];
    echo "<div style='background: {$c['bg']}; color: {$c['color']}; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 5px solid {$c['border']};'>";
    if ($title) echo "<strong>$title</strong><br>";
    echo $content;
    echo "</div>";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico CSRF v2 - FleboCenter</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { background: white; padding: 30px; border-radius: 15px; max-width: 1200px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        h1 { color: #667eea; border-bottom: 3px solid #764ba2; padding-bottom: 10px; }
        h2 { color: #764ba2; margin-top: 30px; border-left: 4px solid #667eea; padding-left: 15px; }
        .test-section { background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #dee2e6; }
        th { background: #667eea; color: white; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .badge { display: inline-block; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .badge-ok { background: #28a745; color: white; }
        .badge-error { background: #dc3545; color: white; }
        .badge-warning { background: #ffc107; color: #000; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔐 Diagnóstico CSRF v2 - FleboCenter iPage</h1>
    <p><strong>Fecha:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
    <p><strong>Servidor:</strong> <?php echo $_SERVER['HTTP_HOST'] ?? 'No disponible'; ?></p>

    <?php
    // ====================================
    // TEST 1: AUTOLOAD Y BOOTSTRAP
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>📦 Test 1: Laravel Bootstrap</h2>';
    
    $laravelOK = false;
    $configOK = false;
    
    try {
        if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
            showSection('❌ Error', 'vendor/autoload.php NO encontrado', 'error');
        } else {
            require __DIR__ . '/../vendor/autoload.php';
            showSection('✅ OK', 'vendor/autoload.php cargado', 'success');
            
            if (!file_exists(__DIR__ . '/../bootstrap/app.php')) {
                showSection('❌ Error', 'bootstrap/app.php NO encontrado', 'error');
            } else {
                $app = require_once __DIR__ . '/../bootstrap/app.php';
                showSection('✅ OK', 'bootstrap/app.php cargado', 'success');
                
                // Bootstrap completo
                $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
                $kernel->bootstrap();
                
                showSection('✅ OK', 'Laravel bootstrapped exitosamente', 'success');
                $laravelOK = true;
                
                // Verificar si config funciona
                try {
                    $test = config('app.name');
                    $configOK = true;
                    showSection('✅ OK', 'Helper config() funcional: ' . $test, 'success');
                } catch (Exception $e) {
                    showSection('❌ Error', 'Helper config() no funciona: ' . $e->getMessage(), 'error');
                }
            }
        }
    } catch (Exception $e) {
        showSection('❌ Error Fatal', $e->getMessage() . '<br><pre>' . $e->getTraceAsString() . '</pre>', 'error');
    }
    
    echo '</div>';

    // ====================================
    // TEST 2: VARIABLES DE ENTORNO
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>⚙️ Test 2: Variables de Entorno (.env)</h2>';
    
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        showSection('❌ Error', 'Archivo .env NO encontrado', 'error');
    } else {
        showSection('✅ OK', 'Archivo .env encontrado', 'success');
        
        $envContent = file_get_contents($envPath);
        $criticalVars = [
            'APP_ENV' => 'Ambiente de la aplicación',
            'APP_KEY' => 'Clave de encriptación',
            'SESSION_DRIVER' => 'Driver de sesiones',
            'SESSION_LIFETIME' => 'Duración de sesión',
            'SESSION_DOMAIN' => 'Dominio de cookies',
        ];
        
        echo '<table><tr><th>Variable</th><th>Descripción</th><th>Estado</th></tr>';
        foreach ($criticalVars as $var => $desc) {
            $exists = preg_match("/^$var=/m", $envContent);
            echo '<tr><td>' . $var . '</td><td>' . $desc . '</td><td>';
            echo $exists ? '<span class="badge badge-ok">✓</span>' : '<span class="badge badge-error">✗</span>';
            echo '</td></tr>';
        }
        echo '</table>';
    }
    
    // Verificar .env.local
    if (file_exists(__DIR__ . '/../.env.local')) {
        showSection('⚠️ Advertencia', 'Archivo .env.local encontrado - puede sobrescribir .env', 'warning');
    }
    
    echo '</div>';

    // ====================================
    // TEST 3: CONFIGURACIÓN DE SESIONES
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>🔧 Test 3: Configuración de Sesiones</h2>';
    
    if ($configOK) {
        echo '<table><tr><th>Configuración</th><th>Valor</th><th>Estado</th></tr>';
        
        $checks = [
            ['SESSION_DRIVER', config('session.driver'), 'file', 'debe ser "file" en iPage'],
            ['SESSION_LIFETIME', config('session.lifetime') . ' min', '120', 'duración de sesión'],
            ['SESSION_DOMAIN', config('session.domain') ?: 'null', '', 'dominio de cookies'],
            ['SESSION_SECURE', config('session.secure') ? 'true' : 'false', 'true', 'HTTPS requerido'],
            ['SESSION_SAME_SITE', config('session.same_site'), 'lax', 'protección CSRF'],
        ];
        
        foreach ($checks as $check) {
            list($name, $value, $expected, $desc) = $check;
            $ok = ($value == $expected || empty($expected));
            echo '<tr><td>' . $name . '</td><td>' . $value . '</td><td>';
            echo $ok ? '<span class="badge badge-ok">OK</span>' : '<span class="badge badge-warning">Revisar</span>';
            echo '<br><small>' . $desc . '</small></td></tr>';
        }
        
        echo '</table>';
        
        // Verificar directorio de sesiones
        try {
            $sessionPath = storage_path('framework/sessions');
            if (is_dir($sessionPath)) {
                if (is_writable($sessionPath)) {
                    showSection('✅ OK', 'Directorio de sesiones escribible: ' . $sessionPath, 'success');
                } else {
                    showSection('❌ Error', 'Directorio NO escribible: ' . $sessionPath . '<br>Ejecutar: chmod 775 storage/framework/sessions', 'error');
                }
            } else {
                showSection('❌ Error', 'Directorio NO existe: ' . $sessionPath, 'error');
            }
        } catch (Exception $e) {
            showSection('⚠️ Advertencia', 'No se pudo verificar directorio: ' . $e->getMessage(), 'warning');
        }
        
    } else {
        showSection('⚠️ Advertencia', 'No se puede leer configuración (config() no funciona)', 'warning');
    }
    
    echo '</div>';

    // ====================================
    // TEST 4: MIDDLEWARE CSRF
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>🛡️ Test 4: Middleware CSRF</h2>';
    
    $kernelPath = __DIR__ . '/../app/Http/Kernel.php';
    if (file_exists($kernelPath)) {
        $kernelContent = file_get_contents($kernelPath);
        
        echo '<table><tr><th>Middleware</th><th>Estado</th><th>Observación</th></tr>';
        
        $hasStandard = strpos($kernelContent, 'VerifyCsrfToken::class') !== false;
        $hasCustom = strpos($kernelContent, 'VerifyCsrfFile::class') !== false;
        
        echo '<tr><td>VerifyCsrfToken</td><td>';
        echo $hasStandard ? '<span class="badge badge-ok">Activo</span>' : '<span class="badge badge-error">Inactivo</span>';
        echo '</td><td>Middleware estándar de Laravel</td></tr>';
        
        echo '<tr><td>VerifyCsrfFile</td><td>';
        echo $hasCustom ? '<span class="badge badge-warning">Activo</span>' : '<span class="badge badge-ok">Inactivo</span>';
        echo '</td><td>';
        echo $hasCustom ? 'Personalizado - puede causar problemas' : 'No en uso';
        echo '</td></tr>';
        
        echo '</table>';
        
        if (!$hasStandard && !$hasCustom) {
            showSection('❌ CRÍTICO', '¡No hay middleware CSRF activo!', 'error');
        }
        
    } else {
        showSection('❌ Error', 'app/Http/Kernel.php NO encontrado', 'error');
    }
    
    // Verificar APP_KEY
    if ($configOK) {
        $appKey = config('app.key');
        if (empty($appKey)) {
            showSection('❌ CRÍTICO', 'APP_KEY no configurada - ejecutar: php artisan key:generate', 'error');
        } else {
            showSection('✅ OK', 'APP_KEY configurada (longitud: ' . strlen($appKey) . ')', 'success');
        }
    }
    
    echo '</div>';

    // ====================================
    // TEST 5: GENERACIÓN DE TOKEN CSRF
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>🔑 Test 5: Generación de Token CSRF</h2>';
    
    if ($laravelOK) {
        try {
            // Iniciar sesión
            if (!session_id()) {
                session_start();
            }
            
            // Intentar generar token
            $token = csrf_token();
            
            if (!empty($token)) {
                showSection('✅ OK', 'Token CSRF generado exitosamente<br>Token: <code>' . htmlspecialchars($token) . '</code><br>Longitud: ' . strlen($token) . ' caracteres', 'success');
                
                // Información de sesión
                echo '<table><tr><th>Parámetro</th><th>Valor</th></tr>';
                echo '<tr><td>Session ID</td><td>' . session_id() . '</td></tr>';
                echo '<tr><td>Session Name</td><td>' . session_name() . '</td></tr>';
                echo '<tr><td>Session Save Path</td><td>' . session_save_path() . '</td></tr>';
                echo '<tr><td>Cookie Lifetime</td><td>' . ini_get('session.cookie_lifetime') . '</td></tr>';
                echo '<tr><td>Cookie Domain</td><td>' . ini_get('session.cookie_domain') . '</td></tr>';
                echo '</table>';
                
            } else {
                showSection('❌ Error', 'No se pudo generar token CSRF', 'error');
            }
            
        } catch (Exception $e) {
            showSection('❌ Error', 'Excepción al generar token: ' . $e->getMessage(), 'error');
        }
    } else {
        showSection('⚠️ Advertencia', 'Laravel no está listo, no se puede generar token', 'warning');
    }
    
    echo '</div>';

    // ====================================
    // TEST 6: PERMISOS DE DIRECTORIOS
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>📁 Test 6: Permisos de Directorios</h2>';
    
    $dirs = [
        'storage' => __DIR__ . '/../storage',
        'storage/framework' => __DIR__ . '/../storage/framework',
        'storage/framework/sessions' => __DIR__ . '/../storage/framework/sessions',
        'storage/logs' => __DIR__ . '/../storage/logs',
        'bootstrap/cache' => __DIR__ . '/../bootstrap/cache',
    ];
    
    echo '<table><tr><th>Directorio</th><th>Existe</th><th>Escribible</th><th>Permisos</th></tr>';
    
    foreach ($dirs as $name => $path) {
        $exists = is_dir($path);
        $writable = $exists && is_writable($path);
        $perms = $exists ? substr(sprintf('%o', fileperms($path)), -4) : 'N/A';
        
        echo '<tr><td>' . $name . '</td><td>';
        echo $exists ? '<span class="badge badge-ok">Sí</span>' : '<span class="badge badge-error">No</span>';
        echo '</td><td>';
        echo $writable ? '<span class="badge badge-ok">Sí</span>' : '<span class="badge badge-error">No</span>';
        echo '</td><td>' . $perms . '</td></tr>';
    }
    
    echo '</table>';
    echo '</div>';

    // ====================================
    // RESUMEN Y RECOMENDACIONES
    // ====================================
    echo '<div class="test-section">';
    echo '<h2>📋 Resumen y Recomendaciones</h2>';
    
    echo '<div style="background: #cfe2ff; padding: 20px; border-radius: 8px; margin: 20px 0;">';
    echo '<h3>💡 Configuración Recomendada para iPage:</h3>';
    echo '<pre style="background: #f8f9fa; color: #000; padding: 15px;">';
    echo 'SESSION_DRIVER=file
SESSION_LIFETIME=480
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

CACHE_DRIVER=file
QUEUE_CONNECTION=sync</pre>';
    echo '</div>';
    
    echo '<div style="background: #fff3cd; padding: 20px; border-radius: 8px;">';
    echo '<h3>🔧 Comandos de Limpieza:</h3>';
    echo '<pre style="background: #f8f9fa; color: #000; padding: 15px;">';
    echo 'php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
chmod -R 775 storage
chmod -R 775 bootstrap/cache</pre>';
    echo '</div>';
    
    echo '</div>';
    ?>

    <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px; text-align: center;">
        <p><strong>FleboCenter - Diagnóstico CSRF v2.0</strong></p>
        <p>Versión mejorada con mejor manejo de errores</p>
    </div>

</div>
</body>
</html>
