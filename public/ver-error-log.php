<?php
/**
 * VER LOG DE ERROR
 */

$logFiles = [
    __DIR__ . '/../storage/logs/laravel.log',
    '/home/users/web/b2263/ipg.szclinicascom/szystems/flebonuevo4/storage/logs/laravel.log',
];

$logContent = null;
$logPath = null;

foreach ($logFiles as $path) {
    if (file_exists($path)) {
        $logPath = $path;
        $lines = file($path);
        $logContent = array_slice($lines, -50); // Últimas 50 líneas
        break;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error Log</title>
    <style>
        body {
            font-family: monospace;
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 20px;
        }
        pre {
            background: #252526;
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
        }
        .error { color: #f48771; }
        .warning { color: #ce9178; }
    </style>
</head>
<body>
    <h1>📋 Últimas 50 líneas del log</h1>
    <?php if ($logContent): ?>
        <p>Archivo: <?php echo htmlspecialchars($logPath); ?></p>
        <pre><?php
            foreach ($logContent as $line) {
                if (strpos($line, 'ERROR') !== false) {
                    echo '<span class="error">' . htmlspecialchars($line) . '</span>';
                } elseif (strpos($line, 'WARNING') !== false) {
                    echo '<span class="warning">' . htmlspecialchars($line) . '</span>';
                } else {
                    echo htmlspecialchars($line);
                }
            }
        ?></pre>
    <?php else: ?>
        <p>❌ No se encontró archivo de log</p>
    <?php endif; ?>
</body>
</html>
