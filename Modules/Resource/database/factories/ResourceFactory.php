<?php

namespace Modules\Resource\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Resource\Models\Resource;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['room', 'vehicle', 'equipment']),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
