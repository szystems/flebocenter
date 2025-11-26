<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Forzar que NO se use SQLite bajo ninguna circunstancia
        $this->app->bind('db.connection.sqlite', function () {
            throw new \Exception('SQLite está deshabilitado. Use MySQL.');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        
        // Forzar MySQL como conexión por defecto
        config(['database.default' => 'mysql']);
    }
}
