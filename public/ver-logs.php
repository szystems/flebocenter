<?php
/**
 * LEER ÚLTIMAS LÍNEAS DEL LOG DE LARAVEL
 * Propósito: Ver si hay errores relacionados con sesiones
 */

$logPath = __DIR__ . '/../storage/logs/laravel.log';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Logs</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        pre {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
            max-height: 600px;
            overflow-y: auto;
        }
        .error {
            color: #e74c3c;
        }
        .warning {
            color: #f39c12;
        }
        .info {
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Últimas 100 líneas del Log de Laravel</h1>
        
        <?php if (file_exists($logPath)): ?>
            <pre><?php
                $lines = file($logPath);
                $lastLines = array_slice($lines, -100);
                
                foreach ($lastLines as $line) {
                    // Colorear según tipo
                    if (strpos($line, '.ERROR:') !== false) {
                        echo '<span class="error">' . htmlspecialchars($line) . '</span>';
                    } elseif (strpos($line, '.WARNING:') !== false) {
                        echo '<span class="warning">' . htmlspecialchars($line) . '</span>';
                    } elseif (strpos($line, '.INFO:') !== false) {
                        echo '<span class="info">' . htmlspecialchars($line) . '</span>';
                    } else {
                        echo htmlspecialchars($line);
                    }
                }
            ?></pre>
        <?php else: ?>
            <p>⚠️ No se encontró el archivo de log: <?php echo htmlspecialchars($logPath); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
