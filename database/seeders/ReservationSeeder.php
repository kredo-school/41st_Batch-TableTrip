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
            Reservation::create([
                'restaurant_id'    => $restaurant->id,
                'user_id'          => $user->id,
                'reservation_date' => '2026-04-20',
                'reservation_time' => '18:00:00',
                'reserved_at'      => now(), 
                'number_of_people' => 5,
                'full_name'        => $user->first_name . ' ' . $user->last_name,
                'phone'            => $user->tel,
                'email'            => $user->email,
                'special_requests' => 'Window seat please.',
                'status'           => 'pending',
                'visited_at'       => null,
            ]);
        }
    }
}