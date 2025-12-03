<?php
/**
 * ACTUALIZAR-ENV.PHP
 * Actualizar configuración de .env sin subir el archivo completo
 * SOLO actualiza las líneas necesarias para sesiones
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🔧 ACTUALIZAR CONFIGURACIÓN .ENV\n";
echo str_repeat("=", 70) . "\n\n";

$rootDir = dirname(__DIR__);
$envPath = $rootDir . '/.env';

if (!file_exists($envPath)) {
    echo "❌ Archivo .env no encontrado en: $envPath\n";
    exit(1);
}

echo "PASO 1: Leer .env actual\n";
echo str_repeat("-", 70) . "\n";

$envContent = file_get_contents($envPath);
$originalContent = $envContent;

echo "✅ Archivo .env leído\n";
echo "   Tamaño: " . strlen($envContent) . " bytes\n\n";

echo "PASO 2: Verificar y actualizar configuraciones\n";
echo str_repeat("-", 70) . "\n";

$changes = [];

// SESSION_DRIVER
if (strpos($envContent, 'SESSION_DRIVER=') !== false) {
    if (!preg_match('/SESSION_DRIVER=database/', $envContent)) {
        $envContent = preg_replace('/SESSION_DRIVER=([^\r\n]+)/', 'SESSION_DRIVER=database', $envContent);
        $changes[] = "SESSION_DRIVER → database";
        echo "✅ SESSION_DRIVER cambiado a 'database'\n";
    } else {
        echo "✓ SESSION_DRIVER ya es 'database'\n";
    }
} else {
    $envContent .= "\nSESSION_DRIVER=database\n";
    $changes[] = "SESSION_DRIVER agregado";
    echo "✅ SESSION_DRIVER agregado\n";
}

// SESSION_SAME_SITE
if (strpos($envContent, 'SESSION_SAME_SITE=') !== false) {
    if (!preg_match('/SESSION_SAME_SITE=none/', $envContent)) {
        $envContent = preg_replace('/SESSION_SAME_SITE=([^\r\n]+)/', 'SESSION_SAME_SITE=none', $envContent);
        $changes[] = "SESSION_SAME_SITE → none";
        echo "✅ SESSION_SAME_SITE cambiado a 'none'\n";
    } else {
        echo "✓ SESSION_SAME_SITE ya es 'none'\n";
    }
} else {
    // Buscar dónde insertar (después de SESSION_COOKIE)
    if (strpos($envContent, 'SESSION_COOKIE=') !== false) {
        $envContent = preg_replace('/SESSION_COOKIE=([^\r\n]+)/', "SESSION_COOKIE=$1\nSESSION_DOMAIN=.flebocenter.com\nSESSION_SECURE_COOKIE=true\nSESSION_SAME_SITE=none", $envContent);
    } else {
        $envContent .= "\nSESSION_SAME_SITE=none\n";
    }
    $changes[] = "SESSION_SAME_SITE agregado";
    echo "✅ SESSION_SAME_SITE agregado\n";
}

// SESSION_DOMAIN
if (strpos($envContent, 'SESSION_DOMAIN=') !== false) {
    if (!preg_match('/SESSION_DOMAIN=\.flebocenter\.com/', $envContent)) {
        $envContent = preg_replace('/SESSION_DOMAIN=([^\r\n]+)/', 'SESSION_DOMAIN=.flebocenter.com', $envContent);
        $changes[] = "SESSION_DOMAIN → .flebocenter.com";
        echo "✅ SESSION_DOMAIN cambiado a '.flebocenter.com'\n";
    } else {
        echo "✓ SESSION_DOMAIN ya es '.flebocenter.com'\n";
    }
} else {
    $changes[] = "SESSION_DOMAIN agregado";
    echo "✅ SESSION_DOMAIN agregado\n";
}

// SESSION_SECURE_COOKIE
if (strpos($envContent, 'SESSION_SECURE_COOKIE=') !== false) {
    if (!preg_match('/SESSION_SECURE_COOKIE=true/', $envContent)) {
        $envContent = preg_replace('/SESSION_SECURE_COOKIE=([^\r\n]+)/', 'SESSION_SECURE_COOKIE=true', $envContent);
        $changes[] = "SESSION_SECURE_COOKIE → true";
        echo "✅ SESSION_SECURE_COOKIE cambiado a 'true'\n";
    } else {
        echo "✓ SESSION_SECURE_COOKIE ya es 'true'\n";
    }
}

// SESSION_HTTP_ONLY
if (strpos($envContent, 'SESSION_HTTP_ONLY=') === false) {
    // Insertar después de SESSION_ENCRYPT o al final de la sección SESSION
    if (strpos($envContent, 'SESSION_ENCRYPT=') !== false) {
        $envContent = preg_replace('/SESSION_ENCRYPT=([^\r\n]+)/', "SESSION_ENCRYPT=$1\nSESSION_HTTP_ONLY=true", $envContent);
    } else {
        $envContent .= "\nSESSION_HTTP_ONLY=true\n";
    }
    $changes[] = "SESSION_HTTP_ONLY agregado";
    echo "✅ SESSION_HTTP_ONLY agregado\n";
} else {
    echo "✓ SESSION_HTTP_ONLY ya existe\n";
}

if (empty($changes)) {
    echo "\n";
    echo str_repeat("=", 70) . "\n";
    echo "✅ CONFIGURACIÓN YA ESTÁ CORRECTA\n";
    echo str_repeat("=", 70) . "\n\n";
    echo "No se requieren cambios en .env\n\n";
} else {
    echo "\nPASO 3: Guardar cambios\n";
    echo str_repeat("-", 70) . "\n";
    
    // Backup del original
    $backupPath = $rootDir . '/.env.backup.' . date('YmdHis');
    file_put_contents($backupPath, $originalContent);
    echo "✅ Backup creado: " . basename($backupPath) . "\n";
    
    // Guardar nuevo contenido
    file_put_contents($envPath, $envContent);
    echo "✅ Archivo .env actualizado\n\n";
    
    echo str_repeat("=", 70) . "\n";
    echo "✅✅✅ ACTUALIZACIÓN COMPLETADA ✅✅✅\n";
    echo str_repeat("=", 70) . "\n\n";
    
    echo "📋 CAMBIOS REALIZADOS:\n\n";
    foreach ($changes as $i => $change) {
        echo ($i + 1) . ". $change\n";
    }
}

echo "\n📊 CONFIGURACIÓN ACTUAL DE SESIONES:\n";
echo str_repeat("-", 70) . "\n";

preg_match('/SESSION_DRIVER=([^\r\n]+)/', $envContent, $driver);
preg_match('/SESSION_SAME_SITE=([^\r\n]+)/', $envContent, $sameSite);
preg_match('/SESSION_DOMAIN=([^\r\n]+)/', $envContent, $domain);
preg_match('/SESSION_SECURE_COOKIE=([^\r\n]+)/', $envContent, $secure);
preg_match('/SESSION_HTTP_ONLY=([^\r\n]+)/', $envContent, $httpOnly);

echo "SESSION_DRIVER: " . ($driver[1] ?? 'no configurado') . "\n";
echo "SESSION_SAME_SITE: " . ($sameSite[1] ?? 'no configurado') . "\n";
echo "SESSION_DOMAIN: " . ($domain[1] ?? 'no configurado') . "\n";
echo "SESSION_SECURE_COOKIE: " . ($secure[1] ?? 'no configurado') . "\n";
echo "SESSION_HTTP_ONLY: " . ($httpOnly[1] ?? 'no configurado') . "\n";

echo "\n🔄 PRÓXIMOS PASOS:\n\n";
echo "1. Ejecutar: limpiar-opcache.php\n";
echo "2. Ejecutar: regenerar-cache-artisan.php\n";
echo "3. Ejecutar: diagnostico-cookies-sesiones.php\n";
echo "4. Limpiar cookies del navegador\n";
echo "5. Probar login\n\n";

echo "Ejecutado: " . date('Y-m-d H:i:s') . "\n";
