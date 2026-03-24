<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Resercation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

public function definition(): array
{
    return [
        'restaurant_id' => 2, // 固定
        'user_id' => null, // nullableだからOK

        'reservation_date' => $this->faker->dateTimeBetween('now', '+7 days')->format('Y-m-d'),

        'reservation_time' => $this->faker->randomElement([
            '11:00:00',
            '12:00:00',
            '13:00:00',
            '18:00:00',
            '19:00:00',
            '20:00:00',
        ]),

        'number_of_people' => $this->faker->numberBetween(1, 6),

        'full_name' => $this->faker->name(),

        'phone' => $this->faker->phoneNumber(),

        'email' => $this->faker->optional()->safeEmail(),

        'special_requests' => $this->faker->optional()->sentence(),

        'status' => $this->faker->randomElement([
            'pending',
            'confirmed',
            'completed',
            'cancelled',
            'no-show'
        ]),

        'visited_at' => $this->faker->optional()->dateTimeBetween('-1 days', 'now'),
    ];
}
}
