<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ModuleMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module-migrate {module : The name of the module to migrate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for a specific module';

    /**
     * Execute the console command.
     *
     * @param  string  $module
     * @return void
     */
    public function handle($module = null)
    {
        // If module not provided as argument, prompt user
        if (! $module) {
            $module = $this->ask('Which module do you want to migrate?');
        }

        // Validate module input
        if (empty($module)) {
            $this->error('No module specified.');

            return;
        }

        // Normalize module name (ensure first letter is uppercase)
        $module = ucfirst(strtolower($module));

        // Check if module model exists and is enabled
        $moduleModel = Module::where('name', $module)->first();
        if (! $moduleModel) {
            $this->error("Module {$module} not found in the database.");

            return;
        }

        if (! $moduleModel->isEnabled()) {
            $this->error("Module {$module} is not currently enabled.");

            return;
        }

        // Attempt to migrate the module
        try {
            $this->migrateModule($module, $moduleModel);
        } catch (\Exception $e) {
            $this->error("Migration failed for module {$module}: ".$e->getMessage());

            // Optional: log the full error for debugging
            Log::error('Module Migration Error', [
                'module' => $module,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Migrate a specific module.
     *
     * @param  string  $module
     * @return void
     */
    protected function migrateModule($module, $moduleModel)
    {
        // Use Laravel's base_path() to ensure correct path generation
        $modulePath = base_path("Modules/{$module}/database/migrations");

        // Check if migrations directory exists
        if (! File::exists($modulePath)) {
            $this->error("Migrations directory not found for module {$module}.");

            return;
        }

        // Get all migration files
        $migrationFiles = File::glob($modulePath.'/*.php');

        if (empty($migrationFiles)) {
            $this->warn("No migration files found for module {$module}.");

            return;
        }

        // Run migrations with verbose output
        $this->info("Starting migrations for module {$module}...");

        $result = Artisan::call('migrate', [
            '--path' => "Modules/{$module}/database/migrations",
            '--force' => true,
            '--verbose' => true,
        ]);

        // Check migration result
        if ($result === 0) {
            $moduleModel->last_migrated_at = now();
            $moduleModel->save();
            $this->info("Migrations for {$module} module completed successfully.");
        } else {
            $this->error("Migrations for {$module} module encountered issues.");
        }

        // Display migration output
        $output = Artisan::output();
        $this->line($output);
    }
}
