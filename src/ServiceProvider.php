<?php

namespace Taskforcedev\CrudApi;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider.
 *
 * @version 1.0.0
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot method.
     * Loads routes and configuration.
     */
    public function boot()
    {
        /* Load our routes */
        $this->loadRoutes();
        /* Load views */
        $this->loadViews();
        /* Register config file */
        $this->config();
    }

    /**
     * Registers the configuration.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/crudapi.php', 'crudapi'
        );
    }

    /**
     * Allows configuration to be publishable, this allows user to override
     * values without editing package.
     */
    protected function config()
    {
        $this->publishes(
            [
                __DIR__.'/../config/crudapi.php' => config_path('crudapi.php'),
            ], 'crudapi-config'
        );
    }

    /**
     * Load the package routes (if the file exists).
     */
    protected function loadRoutes()
    {
        $routes_path = __DIR__.'/Http/routes.php';
        if (file_exists($routes_path)) {
            include __DIR__.'/Http/routes.php';
        }
    }

    /**
     * Load the packages views.
     */
    protected function loadViews()
    {
        $view_path = __DIR__.'/../resources/views';
        $this->loadViewsFrom($view_path, 'crudapi');
        $this->publishes(
            [
                $view_path => base_path('resources/views/Taskforcedev/crudapi'),
            ], 'crudapi-views'
        );
    }
}
