<?php

namespace App\Traits;

trait UseModuleDatabase
{
    protected static function bootUsesModuleDatabase()
    {
        static::creating(function ($model) {
            if (property_exists($model, 'module') && $model->module) {
                $connection = match ($model->module) {
                    'General' => 'mysql_general',
                    'Motors' => 'mysql_motors',
                    'Jobs' => 'mysql_jobs',
                    default => 'mysql',
                };

                $model->setConnection($connection);
            }
        });
    }
}
