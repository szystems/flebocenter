<?php
/**
 * Capturar HTML completo del dashboard
 */

// Simular sesión autenticada
session_start();

// Cargar Laravel y hacer request interno
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Crear request simulando usuario autenticado
$request = Illuminate\Http\Request::create(
    'https://www.flebocenter.com/dashboard',
    'GET',
    [],
    ['app_session' => $_COOKIE['app_session'] ?? '']
);

$response = $kernel->handle($request);

// Guardar HTML en archivo
$html = $response->getContent();
$filename = 'dashboard-captured-' . date('YmdHis') . '.html';
file_put_contents(__DIR__ . '/' . $filename, $html);

// Mostrar resultado
header('Content-Type: text/html; charset=utf-8');
echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Dashboard Capturado</title>
    <style>
        body { font-family: monospace; background: #1e1e1e; color: #d4d4d4; padding: 20px; }
        .success { color: #4ec9b0; }
        pre { background: #252526; padding: 15px; border-radius: 5px; max-height: 500px; overflow-y: scroll; }
    </style>
</head>
<body>
    <h1>📄 Dashboard HTML Capturado</h1>
    <p class='success'>✅ Guardado en: <a href='/{$filename}' style='color: #4ec9b0;'>{$filename}</a></p>
    <p>Tamaño: " . number_format(strlen($html)) . " caracteres</p>
    
    <h2>Primeros 2000 caracteres:</h2>
    <pre>" . htmlspecialchars(substr($html, 0, 2000)) . "</pre>
    
    <h2>Últimos 1000 caracteres:</h2>
    <pre>" . htmlspecialchars(substr($html, -1000)) . "</pre>
</body>
</html>";

$kernel->terminate($request, $response);
