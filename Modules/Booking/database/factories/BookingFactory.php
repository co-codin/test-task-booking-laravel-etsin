<?php

namespace Modules\Booking\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Resource\Models\Resource;
use Modules\User\Models\User;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Booking\Models\Booking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+7 days');
        $end = (clone $start)->modify('+'.$this->faker->numberBetween(1, 4).' hours');

        return [
            'resource_id' => Resource::factory(),
            'user_id' => User::factory(),
            'start_time' => $start->format('Y-m-d H:i:s'),
            'end_time' => $end->format('Y-m-d H:i:s'),
        ];
    }
}
