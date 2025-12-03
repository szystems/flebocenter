<?php
/**
 * CAPTURAR HEADERS DE LARAVEL EN VIVO
 */

// Buffering para capturar headers
ob_start();

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Capturar headers ANTES de enviarlos
$responseHeaders = $response->headers->all();

// Limpiar buffer pero NO enviar
ob_end_clean();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Captura de Headers Laravel</title>
    <style>
        body {
            font-family: monospace;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #1e1e1e;
            color: #d4d4d4;
        }
        .box {
            background: #252526;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #007acc;
        }
        h2 { color: #4ec9b0; margin-top: 0; }
        pre {
            background: #1e1e1e;
            padding: 15px;
            border-radius: 3px;
            overflow-x: auto;
            white-space: pre-wrap;
        }
        .success { color: #4ec9b0; }
        .error { color: #f48771; }
        .warning { color: #ce9178; }
    </style>
</head>
<body>
    <h1>🔬 CAPTURA DE HEADERS - LARAVEL RESPONSE</h1>

    <div class="box">
        <h2>📨 Headers que Laravel va a enviar:</h2>
        <pre><?php
            $hasCookie = false;
            $hasSessionCookie = false;
            
            foreach ($responseHeaders as $name => $values) {
                foreach ($values as $value) {
                    echo "$name: $value\n";
                    
                    if (strtolower($name) === 'set-cookie') {
                        $hasCookie = true;
                        if (strpos($value, 'flebocenter_session') !== false) {
                            $hasSessionCookie = true;
                            echo "  <span class='success'>✅✅✅ COOKIE DE SESIÓN ENCONTRADA!</span>\n";
                        }
                    }
                }
            }
            
            if (!$hasCookie) {
                echo "\n<span class='error'>❌ NO se encontró ningún header Set-Cookie</span>\n";
            } elseif (!$hasSessionCookie) {
                echo "\n<span class='warning'>⚠️ Hay Set-Cookie pero NO es flebocenter_session</span>\n";
            }
        ?></pre>
    </div>

    <div class="box">
        <h2>🔍 Análisis de Cookies:</h2>
        <pre><?php
            $cookieHeaders = isset($responseHeaders['set-cookie']) ? $responseHeaders['set-cookie'] : [];
            
            if (empty($cookieHeaders)) {
                echo "<span class='error'>❌ Laravel NO está estableciendo cookies</span>\n\n";
                echo "POSIBLES CAUSAS:\n";
                echo "1. StartSession middleware no se ejecuta correctamente\n";
                echo "2. Hay un error silencioso en el middleware\n";
                echo "3. La sesión se inicia pero la cookie se pierde\n";
            } else {
                echo "<span class='success'>✅ Laravel SÍ está estableciendo cookies:</span>\n\n";
                foreach ($cookieHeaders as $cookie) {
                    echo "Cookie: $cookie\n\n";
                    
                    // Parsear cookie
                    $parts = explode(';', $cookie);
                    $nameValue = array_shift($parts);
                    list($cookieName, $cookieValue) = explode('=', $nameValue, 2);
                    
                    echo "  Nombre: $cookieName\n";
                    echo "  Valor: " . substr($cookieValue, 0, 50) . "...\n";
                    echo "  Atributos:\n";
                    foreach ($parts as $attr) {
                        echo "    " . trim($attr) . "\n";
                    }
                    echo "\n";
                }
            }
        ?></pre>
    </div>

    <div class="box">
        <h2>💾 Session Store Info:</h2>
        <pre><?php
            try {
                $session = $request->session();
                echo "Session ID: " . $session->getId() . "\n";
                echo "Session Name: " . $session->getName() . "\n";
                echo "Session Started: " . ($session->isStarted() ? 'YES' : 'NO') . "\n";
                echo "Has _token: " . ($session->has('_token') ? 'YES' : 'NO') . "\n";
                
                // Forzar regeneración de token
                $session->regenerateToken();
                echo "\n<span class='success'>✅ Token regenerado</span>\n";
            } catch (\Exception $e) {
                echo "<span class='error'>ERROR: " . $e->getMessage() . "</span>\n";
            }
        ?></pre>
    </div>

</body>
</html>
<?php
// Ahora SÍ enviar la respuesta
$response->send();
$kernel->terminate($request, $response);
?>
