<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Restaurant;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'satonao@kredo.com')->first();
        $restaurant = Restaurant::first();

        if ($user && $restaurant) {
            $reservations = [
                [
                    'label' => 'Upcoming reservation',
                    'reservation_date' => '2026-04-20', 
                    'reservation_time' => '18:00:00',
                    'number_of_people' => 5,
                ],
                [
                    'label' => 'Past reservation',
                    'reservation_date' => '2026-04-10', 
                    'reservation_time' => '19:00:00',
                    'number_of_people' => 2,
                ],
            ];

            foreach ($reservations as $data) {
                Reservation::updateOrCreate(
                    [
                        'user_id'          => $user->id,
                        'restaurant_id'    => $restaurant->id,
                        'reservation_date' => $data['reservation_date'],
                    ],
                    [
                        'reservation_time' => $data['reservation_time'],
                        'reserved_at'      => now(), 
                        'number_of_people' => $data['number_of_people'],
                        'full_name'        => $user->first_name . ' ' . $user->last_name,
                        'phone'            => $user->tel,
                        'email'            => $user->email,
                        'special_requests' => $data['label'] . 'のテストデータです。',
                        'status'           => 'pending',
                        'visited_at'       => null,
                    ]
                );
            }
        }
    }
}