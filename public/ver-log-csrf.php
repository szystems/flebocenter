<?php
/**
 * Ver últimas líneas del log de Laravel - Específico para errores CSRF
 */

$logPath = dirname(__DIR__) . '/storage/logs/laravel.log';

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Log CSRF - Laravel</title>
    <style>
        body { font-family: monospace; background: #1e1e1e; color: #d4d4d4; padding: 20px; }
        .error { color: #f44747; font-weight: bold; }
        .csrf { color: #ffa500; background: rgba(255,165,0,0.1); padding: 2px 5px; }
        .success { color: #4ec9b0; }
        .info { color: #9cdcfe; }
        pre { background: #252526; padding: 15px; border-radius: 5px; overflow-x: auto; }
        h2 { color: #4ec9b0; }
        .timestamp { color: #858585; }
    </style>
</head>
<body>
    <h1>📋 Log de Errores CSRF - Laravel</h1>
";

if (!file_exists($logPath)) {
    echo "<p class='error'>❌ Archivo de log no encontrado: {$logPath}</p>";
    echo "</body></html>";
    exit;
}

// Leer últimas 200 líneas del log
$lines = [];
$fp = fopen($logPath, 'r');

// Ir al final del archivo
fseek($fp, -1, SEEK_END);
$pos = ftell($fp);
$line = '';
$lineCount = 0;

// Leer de atrás hacia adelante
while ($pos > 0 && $lineCount < 200) {
    fseek($fp, $pos, SEEK_SET);
    $char = fgetc($fp);
    
    if ($char === "\n" && $line !== '') {
        $lines[] = $line;
        $line = '';
        $lineCount++;
    } else {
        $line = $char . $line;
    }
    
    $pos--;
}

if ($line !== '') {
    $lines[] = $line;
}

fclose($fp);

// Invertir para mostrar cronológicamente
$lines = array_reverse($lines);

// Filtrar solo líneas relacionadas con CSRF
$csrfLines = [];
$contextLines = 3; // Líneas de contexto antes y después

foreach ($lines as $index => $line) {
    if (stripos($line, 'csrf') !== false || 
        stripos($line, 'token') !== false ||
        stripos($line, 'login') !== false ||
        stripos($line, 'authenticate') !== false) {
        
        // Agregar líneas de contexto
        $start = max(0, $index - $contextLines);
        $end = min(count($lines) - 1, $index + $contextLines);
        
        for ($i = $start; $i <= $end; $i++) {
            if (!isset($csrfLines[$i])) {
                $csrfLines[$i] = $lines[$i];
            }
        }
    }
}

ksort($csrfLines);

if (empty($csrfLines)) {
    echo "<p class='info'>ℹ️ No se encontraron errores CSRF recientes en el log</p>";
    echo "<p>Mostrando últimas 50 líneas del log completo:</p>";
    $csrfLines = array_slice($lines, -50, 50, true);
}

echo "<h2>Últimas entradas relacionadas con CSRF/Login (" . count($csrfLines) . " líneas):</h2>";
echo "<pre>";

foreach ($csrfLines as $line) {
    $line = htmlspecialchars($line);
    
    // Resaltar errores
    if (stripos($line, 'error') !== false || stripos($line, 'exception') !== false) {
        $line = "<span class='error'>{$line}</span>";
    }
    // Resaltar CSRF
    elseif (stripos($line, 'csrf') !== false) {
        $line = "<span class='csrf'>{$line}</span>";
    }
    // Resaltar timestamps
    elseif (preg_match('/\[\d{4}-\d{2}-\d{2}/', $line)) {
        $line = preg_replace('/(\[\d{4}-\d{2}-\d{2}[^\]]+\])/', '<span class="timestamp">$1</span>', $line);
    }
    
    echo $line . "\n";
}

echo "</pre>";

// Información del archivo
$fileSize = filesize($logPath);
$lastModified = date('Y-m-d H:i:s', filemtime($logPath));

echo "<hr>";
echo "<p class='info'>📄 Archivo: {$logPath}</p>";
echo "<p class='info'>📊 Tamaño: " . number_format($fileSize / 1024, 2) . " KB</p>";
echo "<p class='info'>🕒 Última modificación: {$lastModified}</p>";

echo "</body></html>";
