<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Register Configuration Repository (Laravel 12 Fix)
|--------------------------------------------------------------------------
|
| Laravel 12 requires explicit configuration repository registration
| for applications using the Laravel 10 structure.
|
*/

$app->singleton('config', function ($app) {
    $configCache = $app->bootstrapPath('cache/config.php');
    
    // Si el cache existe, cargarlo
    if (file_exists($configCache)) {
        return new Illuminate\Config\Repository(
            require $configCache
        );
    }
    
    // Si no existe, cargar configuración sin cache
    $config = new Illuminate\Config\Repository();
    
    // Cargar archivos de configuración individuales
    $configPath = $app->basePath('config');
    
    foreach (glob($configPath . '/*.php') as $file) {
        $key = basename($file, '.php');
        $config->set($key, require $file);
    }
    
    return $config;
});

$app->instance('config', $app->make('config'));

/*
|--------------------------------------------------------------------------
| Register Core Service Providers (Laravel 12 Fix)
|--------------------------------------------------------------------------
|
| Laravel 12 requires explicit registration of core service providers
| when using Laravel 10 structure. We register SessionServiceProvider
| here to ensure sessions and CSRF tokens work correctly.
|
*/

// Registrar SessionServiceProvider explícitamente
$app->register(\Illuminate\Session\SessionServiceProvider::class);

// Registrar otros providers críticos que dependen de sesiones
$app->register(\Illuminate\View\ViewServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
