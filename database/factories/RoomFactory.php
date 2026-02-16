<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->buildingNumber(),
            'capacity' => $this->faker->numberBetween(1,8),
            'price_per_night' => $this->faker->numberBetween(500_000,10_000_000)
        ];
    }
}
