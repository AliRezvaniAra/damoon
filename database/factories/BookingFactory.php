<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $room = Room::inRandomOrder()->first();

        $checkIn = $this->faker->dateTimeBetween('now', '+30 days');
        $checkOut = $this->faker->dateTimeBetween(
            $checkIn->format('Y-m-d H:i:s'),
            Carbon::instance($checkIn)->addDays(14)->format('Y-m-d H:i:s')
        );

        $checkIn = Carbon::instance($checkIn);
        $checkOut = Carbon::instance($checkOut);

        $nights = $checkOut->diffInDays($checkIn);

        return [
            'room_id' => $room->id,
            'user_name' => $this->faker->userName(),
            'user_email' => $this->faker->email(),
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'total_price' => $room->price * max($nights, 1),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
