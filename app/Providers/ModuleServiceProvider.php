<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modulesPath = app_path('Modules');

        // Check if Modules directory exists
        if (File::exists($modulesPath)) {
            // Iterate through module directories
            foreach (File::directories($modulesPath) as $moduleDir) {
                $migrationPath = $moduleDir.'/Migrations';

                // Check if Migration directory exists
                if (File::exists($migrationPath)) {
                    // Load migrations from this path
                    $this->loadMigrationsFrom($migrationPath);
                }
            }
        }
    }

    public function register()
    {
        // Any additional registration logic
    }
}
