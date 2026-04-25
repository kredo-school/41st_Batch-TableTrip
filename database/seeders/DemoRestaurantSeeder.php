<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class DemoRestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $prefectures = [
            'Hokkaido','Aomori','Iwate','Miyagi','Akita','Yamagata','Fukushima',
            'Ibaraki','Tochigi','Gunma','Saitama','Chiba','Tokyo','Kanagawa',
            'Niigata','Toyama','Ishikawa','Fukui','Yamanashi','Nagano',
            'Gifu','Shizuoka','Aichi','Mie',
            'Shiga','Kyoto','Osaka','Hyogo','Nara','Wakayama',
            'Tottori','Shimane','Okayama','Hiroshima','Yamaguchi',
            'Tokushima','Kagawa','Ehime','Kochi',
            'Fukuoka','Saga','Nagasaki','Kumamoto','Oita','Miyazaki','Kagoshima','Okinawa'
        ];

        $hours = [
            '09:00 - 20:00',
            '10:00 - 22:00',
            '11:00 - 23:00',
            '08:00 - 19:00',
            '12:00 - 21:00',
        ];

        $names = [
            'Kitchen',
            'Bistro',
            'Table',
            'Grill',
            'Garden',
            'House',
            'Dining',
            'Terrace',
            'Cafe',
        ];

        $prefix = [
            'The',
            'Urban',
            'Modern',
            'Classic',
            'Authentic',
        ];

        foreach ($prefectures as $prefecture) {

            $status = rand(1, 10) <= 7 ? 'approved' : 'pending';

            $opening = $hours[array_rand($hours)];

            $restaurantName =
            $prefix[array_rand($prefix)] . ' ' .
            $prefecture . ' ' .
            $names[array_rand($names)];

            Restaurant::firstOrCreate([
                'prefecture' => $prefecture
            ],[
                'restaurant_name' => $restaurantName,
                'email' => strtolower($prefecture) . '@test.com',
                'phone' => '090-1234-5678',
                'prefecture' => $prefecture,
                'city' => 'Sample City',
                'address_line' => '1-1-1 Sample',
                'opening_hours' => $opening,
                'reservation_limit' => 10,
                'approval_status' => $status,
                'password' => bcrypt('password'),
            ]);
        }
    }
}