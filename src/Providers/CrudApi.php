<?php

namespace Taskforcedev\CrudAPI\Providers;

use Illuminate\Support\ServiceProvider;

class CrudApi extends ServiceProvider
{
    public function boot()
    {
        /* Load our routes */
        $this->loadRoutes();
    }

    protected function loadRoutes()
    {
        $routes_path = __DIR__.'/../Http/routes.php';
        if (file_exists($routes_path)) {
            include __DIR__.'/../Http/routes.php';
        }
    }
}
