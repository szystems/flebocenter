<?php
/**
 * REGENERAR AUTOLOAD DE COMPOSER
 */

$rootDir = dirname(__DIR__);
$composerPath = $rootDir . '/composer.json';

if (!file_exists($composerPath)) {
    die("❌ No se encontró composer.json");
}

echo "<h1>🔧 Regenerando Autoload de Composer...</h1>";
echo "<pre>";

// Cambiar al directorio del proyecto
chdir($rootDir);

// Ejecutar composer dump-autoload
$command = 'composer dump-autoload -o 2>&1';
$output = shell_exec($command);

if ($output) {
    echo htmlspecialchars($output);
    echo "\n\n✅ Autoload regenerado\n";
} else {
    echo "⚠️ No se pudo ejecutar composer\n";
    echo "Intenta manualmente:\n";
    echo "1. Conecta por SSH/FTP\n";
    echo "2. cd /szystems/flebonuevo4\n";
    echo "3. composer dump-autoload -o\n";
}

echo "</pre>";
?>
