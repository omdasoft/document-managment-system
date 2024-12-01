<?php

namespace Database\Factories;

use App\Enums\ModuleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(ModuleType::cases())->value,
            'enabled' => $this->faker->randomElement([0, 1]),
            'last_migrated_at' => now(),
        ];
    }
}
