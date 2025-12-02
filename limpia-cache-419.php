<?php
/**
 * LIMPIA-CACHE-419.PHP
 * Limpiar caché después de aplicar fix Error 419
 * Ejecutar en: https://flebocenter.com/limpia-cache-419.php
 */

header('Content-Type: text/plain; charset=utf-8');

echo "🧹 LIMPIEZA DE CACHÉ - FIX ERROR 419\n";
echo str_repeat("=", 70) . "\n\n";

$cleaned = [];
$errors = [];

// 1. Limpiar config cache
$configCache = __DIR__.'/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    if (unlink($configCache)) {
        $cleaned[] = "✅ Config cache eliminado";
    } else {
        $errors[] = "❌ No se pudo eliminar config cache";
    }
} else {
    $cleaned[] = "ℹ️  Config cache no existía";
}

// 2. Limpiar routes cache
$routesCache = glob(__DIR__.'/bootstrap/cache/routes*.php');
foreach ($routesCache as $file) {
    if (unlink($file)) {
        $cleaned[] = "✅ Routes cache eliminado: " . basename($file);
    } else {
        $errors[] = "❌ No se pudo eliminar: " . basename($file);
    }
}
if (empty($routesCache)) {
    $cleaned[] = "ℹ️  Routes cache no existía";
}

// 3. Limpiar services cache
$servicesCache = __DIR__.'/bootstrap/cache/services.php';
if (file_exists($servicesCache)) {
    if (unlink($servicesCache)) {
        $cleaned[] = "✅ Services cache eliminado";
    } else {
        $errors[] = "❌ No se pudo eliminar services cache";
    }
} else {
    $cleaned[] = "ℹ️  Services cache no existía";
}

// 4. Limpiar compiled cache
$compiledCache = __DIR__.'/bootstrap/cache/compiled.php';
if (file_exists($compiledCache)) {
    if (unlink($compiledCache)) {
        $cleaned[] = "✅ Compiled cache eliminado";
    } else {
        $errors[] = "❌ No se pudo eliminar compiled cache";
    }
}

// 5. Limpiar packages cache
$packagesCache = __DIR__.'/bootstrap/cache/packages.php';
if (file_exists($packagesCache)) {
    if (unlink($packagesCache)) {
        $cleaned[] = "✅ Packages cache eliminado";
    } else {
        $errors[] = "❌ No se pudo eliminar packages cache";
    }
}

// 6. Limpiar sesiones antiguas
$sessionsPath = __DIR__.'/storage/framework/sessions';
$sessionCount = 0;
if (is_dir($sessionsPath)) {
    $sessions = glob($sessionsPath . '/*');
    foreach ($sessions as $session) {
        if (is_file($session)) {
            if (unlink($session)) {
                $sessionCount++;
            }
        }
    }
    $cleaned[] = "✅ Sesiones antiguas eliminadas: $sessionCount archivos";
} else {
    $errors[] = "❌ Directorio de sesiones no existe";
}

// 7. Limpiar views cache
$viewsPath = __DIR__.'/storage/framework/views';
$viewCount = 0;
if (is_dir($viewsPath)) {
    $views = glob($viewsPath . '/*');
    foreach ($views as $view) {
        if (is_file($view) && pathinfo($view, PATHINFO_EXTENSION) === 'php') {
            if (unlink($view)) {
                $viewCount++;
            }
        }
    }
    $cleaned[] = "✅ Views compiladas eliminadas: $viewCount archivos";
}

// Mostrar resultados
echo "📋 ARCHIVOS LIMPIADOS:\n";
echo str_repeat("-", 70) . "\n";
foreach ($cleaned as $item) {
    echo "$item\n";
}

if (!empty($errors)) {
    echo "\n⚠️  ERRORES ENCONTRADOS:\n";
    echo str_repeat("-", 70) . "\n";
    foreach ($errors as $error) {
        echo "$error\n";
    }
}

echo "\n" . str_repeat("=", 70) . "\n";
echo "🎯 RESUMEN\n";
echo str_repeat("=", 70) . "\n";
echo "Archivos limpiados: " . count($cleaned) . "\n";
echo "Errores: " . count($errors) . "\n";

if (empty($errors)) {
    echo "\n✅ LIMPIEZA COMPLETADA EXITOSAMENTE\n\n";
    echo "📋 PRÓXIMOS PASOS:\n";
    echo "1. Regenerar caché: https://flebocenter.com/regenerar-cache-artisan.php\n";
    echo "2. Reiniciar servidor PHP en panel iPage (8.3 → 8.2 → 8.3)\n";
    echo "3. Limpiar cookies del navegador\n";
    echo "4. Probar login: https://flebocenter.com/login\n";
} else {
    echo "\n⚠️  LIMPIEZA COMPLETADA CON ERRORES\n";
    echo "Revisa los errores arriba y corrige permisos si es necesario.\n";
}

echo "\n";
