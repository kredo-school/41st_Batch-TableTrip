<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use Carbon\Carbon;

class DemoReservationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();
        $restaurants = Restaurant::all();

        $statuses = ['pending', 'confirmed', 'visited', 'cancelled'];

        foreach ($users as $user) {
            $reservationCount = rand(1, 3);

            for ($i = 0; $i < $reservationCount; $i++) {
                $restaurant = $restaurants->random();
                $status = $statuses[array_rand($statuses)];

                $reservationDate = Carbon::now()->subDays(rand(1, 60))->addDays(rand(0, 30));
                $reservationTime = Carbon::parse($reservationDate)->setTime(rand(11, 20), [0, 30][rand(0, 1)]);

                Reservation::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'full_name' => trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')),
                    'reservation_date' => $reservationDate->format('Y-m-d'),
                    'reservation_time' => $reservationTime->format('H:i:s'),
                    'reserved_at' => Carbon::now()->subDays(rand(1, 90)),
                    'number_of_people' => rand(1, 5),
                    'phone' => $user->tel ?? '090-0000-0000',
                    'email' => $user->email,
                    'status' => $status,
                    'visited_at' => $status === 'visited' ? $reservationDate : null,
                    'special_requests' => ['Window seat if possible.', 'No allergies.', 'Birthday dinner.', null][rand(0, 3)],
                    'created_at' => Carbon::now()->subDays(rand(1, 90)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
