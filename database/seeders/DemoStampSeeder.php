<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DemoStampSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();

        $prefectures = \App\Models\Restaurant::pluck('prefecture')->unique();

        foreach ($users as $user) {

            $count = rand(1, 10);

            $randomPrefectures = collect($prefectures)->shuffle()->take($count);

            foreach ($randomPrefectures as $prefecture) {

                DB::table('prefecture_stamps')->insert([
                    'user_id' => $user->id,
                    'prefecture' => $prefecture,
                    'earned_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $stampCount = $randomPrefectures->count();

            if ($stampCount === 47) {
                $user->update([
                    'rank' => 'diamond'
                ]);
            }
        }
    }
}
