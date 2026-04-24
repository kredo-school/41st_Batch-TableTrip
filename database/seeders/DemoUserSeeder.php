<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin（必ず作る）
        User::firstOrCreate([
            'email' => 'admin@test.com'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'User',
            'user_name' => 'admin',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $names = [
        // Japanese
            ['Haruto', 'Tanaka'],
            ['Yui', 'Sato'],
            ['Sakura', 'Yamamoto'],
            ['Ren', 'Suzuki'],
            ['Aoi', 'Kobayashi'],
            ['Hinata', 'Ito'],
            ['Mei', 'Watanabe'],
            ['Atsushi', 'Nakamura'],
            ['Hina', 'Kato'],
            ['Sota', 'Yoshida'],

            // Western
            ['Emily', 'Johnson'],
            ['Michael', 'Smith'],
            ['Olivia', 'Brown'],
            ['James', 'Wilson'],
            ['Sophia', 'Taylor'],
            ['Daniel', 'Anderson'],
            ['Isabella', 'Thomas'],
            ['Lucas', 'Jackson'],

            // Asian mix
            ['Wei', 'Zhang'],
            ['Minji', 'Kim'],
            ['Jinwoo', 'Park'],
            ['Xiao', 'Chen'],
            ['An', 'Nguyen'],
        ];

        $addresses = [
            ['Tokyo', '150-0001', '1-2-3 Jingumae, Shibuya-ku, Tokyo'],
            ['Tokyo', '160-0022', '3-5-7 Shinjuku, Shinjuku-ku, Tokyo'],
            ['Osaka', '530-0001', '1-1-1 Umeda, Kita-ku, Osaka'],
            ['Osaka', '542-0085', '2-3-6 Shinsaibashi, Chuo-ku, Osaka'],
            ['Kyoto', '600-8001', '2-3-4 Shijo, Shimogyo-ku, Kyoto'],
            ['Kyoto', '606-8392', '1-5 Okazaki, Sakyo-ku, Kyoto'],
            ['Fukuoka', '810-0001', '3-4-5 Tenjin, Chuo-ku, Fukuoka'],
            ['Fukuoka', '812-0011', '1-2 Hakata Ekimae, Hakata-ku, Fukuoka'],
            ['Hokkaido', '060-0001', '1-5 Kita Ichijo, Chuo-ku, Sapporo'],
            ['Hokkaido', '064-0804', '4-3 Minami 4-jo, Chuo-ku, Sapporo'],
            ['Aichi', '450-0002', '1-1-4 Meieki, Nakamura-ku, Nagoya'],
            ['Aichi', '460-0008', '3-5-12 Sakae, Naka-ku, Nagoya'],
            ['Kanagawa', '220-0005', '2-15 Minatomirai, Nishi-ku, Yokohama'],
            ['Kanagawa', '231-0005', '1-2 Honcho, Naka-ku, Yokohama'],
            ['Hyogo', '650-0022', '1-3 Motomachi, Chuo-ku, Kobe'],
            ['Hyogo', '651-0087', '2-4-6 Goko-dori, Chuo-ku, Kobe'],
            ['Hiroshima', '730-0011', '5-1 Motomachi, Naka-ku, Hiroshima'],
            ['Hiroshima', '732-0822', '2-2 Matsubara-cho, Minami-ku, Hiroshima'],
            ['Sendai', '980-0811', '2-1 Ichibancho, Aoba-ku, Sendai'],
            ['Sendai', '980-0021', '1-1 Chuo, Aoba-ku, Sendai'],
        ];

        $rankPattern = [
            'bronze', 'bronze', 'bronze',
            'silver', 'silver',
            'gold',
            'diamond',
        ];

        for ($i = 1; $i <= 50; $i++) {
            $name = $names[($i - 1) % count($names)];
            $address = $addresses[($i - 1) % count($addresses)];
            $rank = $rankPattern[($i - 1) % count($rankPattern)];

            User::firstOrCreate([
                'email' => "user{$i}@test.com"
            ], [
                'first_name' => $name[0],
                'last_name' => $name[1],
                'user_name' => strtolower($name[0] . $name[1] . $i),
                'tel' => '090-' . str_pad((string)$i, 4, '0', STR_PAD_LEFT) . '-' . str_pad((string)($i + 1000), 4, '0', STR_PAD_LEFT),
                'postal_code' => $address[1],
                'address' => $address[2],
                'country' => 'Japan',
                'password' => bcrypt('password'),
                'rank' => $rank,
                'is_admin' => false,
            ]);
        }
    }
}