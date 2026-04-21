<?php

namespace Database\Seeders;

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
        User::create([
            'first_name'  => 'Naoya',
            'last_name'   => 'Sato',
            'user_name'   => 'iamnaoyasato',
            'email'       => 'satonao@kredo.com',
            'password'    => Hash::make('password914'),
            'tel'         => '627288238',
            'country'     => 'Netherlands',
            'address'     => 'Fukushima', 
            'postal_code' => '9758WK',
        ]);

        // 2. Xuan Wu
        User::create([
            'first_name'  => 'Xuan',
            'last_name'   => 'Wu',
            'user_name'   => 'iamwuxuan',
            'email'       => 'wuxuan@kredo.com',
            'password'    => Hash::make('password527'),
            'tel'         => '60940527',
            'country'     => 'China',
            'address'     => 'shanghai',
            'postal_code' => 'Tianjin',
        ]);

        // 3. Haruto Fujiwara
        User::create([
            'first_name'  => 'Haruto',
            'last_name'   => 'Fujiwara',
            'user_name'   => 'iamharuto',
            'email'       => 'haruto@kredo.com',
            'password'    => Hash::make('password0917'),
            'tel'         => '6187846464',
            'country'     => 'Japan',
            'address'     => 'Akita',
            'postal_code' => '0717WK',
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
