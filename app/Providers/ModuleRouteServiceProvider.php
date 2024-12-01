<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mapModuleRoutes();
    }

    protected function mapModuleRoutes()
    {
        $modules = $this->getModules();

        foreach ($modules as $module) {
            $this->mapApiRoutes($module);
            $this->mapWebRoutes($module);
        }
    }

    protected function getModules()
    {
        return array_map('basename', glob(app_path('Modules/*'), GLOB_ONLYDIR));
    }

    protected function mapApiRoutes($module)
    {
        $routeFile = app_path("Modules/{$module}/Routes/api.php");

        if (file_exists($routeFile)) {
            Route::prefix('api/'.strtolower($module))
                ->middleware('api')
                ->namespace("App\\Modules\\{$module}\\Controllers")
                ->group($routeFile);
        }
    }

    protected function mapWebRoutes($module)
    {
        $routeFile = app_path("Modules/{$module}/Routes/web.php");

        if (file_exists($routeFile)) {
            Route::middleware('web')
                ->namespace("App\\Modules\\{$module}\\Controllers")
                ->group($routeFile);
        }
    }
}
