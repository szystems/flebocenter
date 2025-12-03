<?php
/**
 * TEST-SET-COOKIE.PHP
 * Probar si Laravel puede establecer cookies correctamente
 */

header('Content-Type: text/html; charset=utf-8');

$rootDir = dirname(__DIR__);
require $rootDir . '/vendor/autoload.php';

$app = require_once $rootDir . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Set-Cookie</title>
    <style>
        body { font-family: monospace; margin: 20px; background: #1e1e1e; color: #d4d4d4; }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        pre { background: #252526; padding: 15px; border-left: 3px solid #007acc; }
    </style>
</head>
<body>
    <h1>🍪 TEST: Set-Cookie Manual</h1>

    <h2>PASO 1: Establecer Cookie de Sesión Manualmente</h2>
    <pre>
<?php

// Intentar establecer cookie manualmente
$cookieName = config('session.cookie');
$cookieValue = 'test_' . bin2hex(random_bytes(20));

echo "Cookie Name: $cookieName\n";
echo "Cookie Value: $cookieValue\n\n";

// Método 1: setcookie PHP nativo
$result1 = setcookie(
    $cookieName,
    $cookieValue,
    [
        'expires' => time() + 3600,
        'path' => '/',
        'domain' => '.flebocenter.com',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'None'
    ]
);

echo "setcookie() resultado: " . ($result1 ? "✅ true" : "❌ false") . "\n\n";

// Método 2: header() directo
$cookieHeader = sprintf(
    '%s=%s; Path=/; Domain=.flebocenter.com; Secure; HttpOnly; SameSite=None; Max-Age=3600',
    $cookieName,
    $cookieValue
);

header('Set-Cookie: ' . $cookieHeader, false);
echo "Header Set-Cookie agregado: ✅\n";
echo "Header: $cookieHeader\n";

?>
    </pre>

    <h2>PASO 2: Verificar Headers Enviados</h2>
    <pre>
<?php

if (function_exists('headers_list')) {
    $headers = headers_list();
    echo "Headers que se enviarán:\n\n";
    
    $foundSetCookie = false;
    foreach ($headers as $header) {
        if (stripos($header, 'Set-Cookie') !== false) {
            echo "✅ $header\n";
            $foundSetCookie = true;
        }
    }
    
    if (!$foundSetCookie) {
        echo "❌ No se encontró header Set-Cookie\n";
    }
} else {
    echo "⚠️ headers_list() no disponible\n";
}

?>
    </pre>

    <h2>PASO 3: Usar Cookie Facade de Laravel</h2>
    <pre>
<?php

try {
    // Método 3: Cookie facade de Laravel
    $cookie = Cookie::make(
        $cookieName . '_laravel',
        $cookieValue,
        60, // minutos
        '/',
        '.flebocenter.com',
        true, // secure
        true, // httponly
        false, // raw
        'none' // samesite
    );
    
    echo "✅ Cookie Laravel creada\n";
    echo "Nombre: " . $cookie->getName() . "\n";
    echo "Valor: " . substr($cookie->getValue(), 0, 20) . "...\n";
    echo "Domain: " . $cookie->getDomain() . "\n";
    echo "Secure: " . ($cookie->isSecure() ? 'true' : 'false') . "\n";
    echo "SameSite: " . $cookie->getSameSite() . "\n";
    
    // Queue la cookie
    Cookie::queue($cookie);
    echo "✅ Cookie agregada a la cola\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

?>
    </pre>

    <h2>PASO 4: Iniciar Sesión Laravel</h2>
    <pre>
<?php

try {
    // Iniciar sesión
    session()->start();
    
    echo "✅ Sesión iniciada\n";
    echo "ID: " . session()->getId() . "\n";
    
    // Guardar algo en sesión
    session()->put('test_key', 'test_value_' . time());
    session()->save();
    
    echo "✅ Datos guardados en sesión\n";
    echo "Test value: " . session()->get('test_key') . "\n";
    
    // Verificar en database
    $sessionId = session()->getId();
    $dbSession = DB::table('sessions')->where('id', $sessionId)->first();
    
    if ($dbSession) {
        echo "✅ Sesión encontrada en database\n";
        echo "User ID: " . ($dbSession->user_id ?? 'guest') . "\n";
        echo "IP: " . $dbSession->ip_address . "\n";
    } else {
        echo "❌ Sesión NO encontrada en database\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

?>
    </pre>

    <h2>🎯 RESULTADO</h2>
    <pre>
<?php

echo "INSTRUCCIONES:\n\n";
echo "1. Abre las herramientas de desarrollador (F12)\n";
echo "2. Ve a: Application → Cookies → https://flebocenter.com\n";
echo "3. Busca la cookie: $cookieName\n";
echo "4. Si aparece: ✅ El problema está en el middleware\n";
echo "5. Si NO aparece: ❌ El navegador está bloqueando Set-Cookie\n\n";

echo "VERIFICACIÓN JAVASCRIPT:\n";

?>

<script>
window.addEventListener('DOMContentLoaded', function() {
    console.log('🍪 Cookies disponibles:');
    console.log(document.cookie);
    
    const cookieName = '<?php echo $cookieName; ?>';
    
    if (document.cookie.includes(cookieName)) {
        console.log('✅ Cookie de sesión ENCONTRADA:', cookieName);
        document.write('<p style="color: #4ec9b0;">✅ Cookie de sesión ENCONTRADA en JavaScript</p>');
    } else {
        console.log('❌ Cookie de sesión NO encontrada:', cookieName);
        document.write('<p style="color: #f48771;">❌ Cookie de sesión NO encontrada en JavaScript</p>');
        document.write('<p style="color: #dcdcaa;">Esto significa que httpOnly=true está funcionando (correcto para seguridad)</p>');
    }
});
</script>
    </pre>

    <h2>📋 SIGUIENTE PASO</h2>
    <pre>
Si ves "Set-Cookie" en los headers pero la cookie no persiste:

SOLUCIÓN: Cambiar StartSession a ANTES de EncryptCookies

En app/Http/Kernel.php línea ~33:

'web' => [
    <span style="color: #f48771;">// \App\Http\Middleware\EncryptCookies::class,              ❌ MOVER ABAJO</span>
    <span style="color: #f48771;">// \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,  ❌ MOVER ABAJO</span>
    <span style="color: #4ec9b0;">\Illuminate\Session\Middleware\StartSession::class,      ✅ PRIMERO</span>
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfFile::class,
    <span style="color: #4ec9b0;">\App\Http\Middleware\EncryptCookies::class,              ✅ DESPUÉS</span>
    <span style="color: #4ec9b0;">\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,  ✅ DESPUÉS</span>
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
    </pre>

    <p><strong>Ejecutado:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
</body>
</html>
