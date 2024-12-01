<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillabl = [
        'name',
        'enabled',
        'last_migrated_at',
    ];

    public function isEnabled(): bool
    {
        return $this->attributes['enabled'] === 1;
    }
}
