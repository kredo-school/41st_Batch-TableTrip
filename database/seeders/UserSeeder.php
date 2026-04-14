<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Naoya Sato
        // fixed user account
        // first user
        User::create([
            'first_name' => 'Naoya',
            'last_name' => 'Sato',
            'user_name' => 'iamnaoyasato',
            'email' => 'satonao@kredo.com',
            'password' => Hash::make('password914'),
            'tel' => '627288238',
            'country' => 'Netherlands',
            'address' => 'Fukushima', 
            'postal_code' => '9758WK',
        ]);

        // 2. Xuan Ng
        User::create([
            'first_name' => 'Xuan',
            'last_name' => 'Ng',
            'user_name' => 'ng.xuan',
            'email' => 'ng.xuan@example.com',
            'password' => Hash::make('password123'),
            'tel' => '09012345678',
            'country' => 'Vietnam',
            'address' => 'Ho Chi Minh City',
            'postal_code' => '700000',
        ]);

        // 3. Haruto Tanaka
        User::create([
            'first_name' => 'Haruto',
            'last_name' => 'Tanaka',
            'user_name' => 'haru_tanaka',
            'email' => 'haru@example.com',
            'password' => Hash::make('password789'),
            'tel' => '08098765432',
            'country' => 'Japan',
            'address' => 'Tokyo, Shibuya',
            'postal_code' => '1500002',
        ]);
    }
}
            'tel' => '627288238',
            'email'=>'satonao@kredo.com',
            'postal_code'=> '9758WK',
            'country' => 'Netherlands',
            'address' => 'Fukushima',
            'password' => Hash::make('password914'),            

        ]);

        // second user
        User::create([
            'first_name' => 'Xuan',
            'last_name' => 'Wu',
            'user_name' => 'iamwuxuan',
            'tel' => '60940527',
            'email'=>'wuxuan@kredo.com',
            'postal_code'=> 'Tianjin',
            'country' => 'China',
            'address' => 'shanghai',
            'password' => Hash::make('password527'),            

        ]);

        // third
        User::create([
            'first_name' => 'Haruto',
            'last_name' => 'Fujiwara',
            'user_name' => 'iamharuto',
            'tel' => '6187846464',
            'email'=>'haruto@kredo.com',
            'postal_code'=> '0717WK',
            'country' => 'Japan',
            'address' => 'Akita',
            'password' => Hash::make('password0917'),            

        ]);


    }
}
