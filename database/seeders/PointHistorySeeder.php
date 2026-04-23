<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PointHistory;

class PointHistorySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            PointHistory::create([
                'user_id' => $user->id,
                'points' => rand(100, 500),
                'type' => 'purchase',
                'description' => 'Purchased meal kit',
            ]);

            PointHistory::create([
                'user_id' => $user->id,
                'points' => 50,
                'type' => 'bonus',
                'description' => 'Welcome bonus',
            ]);

            $user->points = PointHistory::where('user_id', $user->id)->sum('points');
            $user->save();
        }
    }
}
