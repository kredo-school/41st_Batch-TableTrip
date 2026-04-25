<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Restaurant;

class DemoProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Categories
        $categoryIds = [];
        $categories = ['Japanese', 'Western', 'Chinese', 'Italian', 'Hot Pot'];
        foreach ($categories as $cat) {
            $existing = DB::table('categories')->where('name', $cat)->first();
            if ($existing) {
                $categoryIds[$cat] = $existing->id;
            } else {
                $categoryIds[$cat] = DB::table('categories')->insertGetId([
                    'name'       => $cat,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 2. Restaurants (20 regional restaurants across Japan)
        $restaurants = [
            ['restaurant_name' => 'Hokkaido Daichi Shokudo',  'prefecture' => 'Hokkaido',    'city' => 'Sapporo',     'category' => 'Japanese'],
            ['restaurant_name' => 'Tsugaru Cuisine Aomori',   'prefecture' => 'Aomori',      'city' => 'Aomori City', 'category' => 'Japanese'],
            ['restaurant_name' => 'Sendai Ajidokoro Date',    'prefecture' => 'Miyagi',      'city' => 'Sendai',      'category' => 'Japanese'],
            ['restaurant_name' => 'Akita Kiritanpo-tei',      'prefecture' => 'Akita',       'city' => 'Akita City',  'category' => 'Hot Pot'],
            ['restaurant_name' => 'Yamagata Imoni Mogamigawa','prefecture' => 'Yamagata',    'city' => 'Yamagata City','category' => 'Hot Pot'],
            ['restaurant_name' => 'Aizu no Sato Fukushima',   'prefecture' => 'Fukushima',   'city' => 'Aizuwakamatsu','category' => 'Japanese'],
            ['restaurant_name' => 'Edomae Nihonbashi',        'prefecture' => 'Tokyo',       'city' => 'Chuo Ward',   'category' => 'Japanese'],
            ['restaurant_name' => 'Yokohama Chinatown Ryuho', 'prefecture' => 'Kanagawa',    'city' => 'Yokohama',    'category' => 'Chinese'],
            ['restaurant_name' => 'Echizen Soba Fukui',       'prefecture' => 'Fukui',       'city' => 'Fukui City',  'category' => 'Japanese'],
            ['restaurant_name' => 'Shinshu Soba Matsumoto',   'prefecture' => 'Nagano',      'city' => 'Matsumoto',   'category' => 'Japanese'],
            ['restaurant_name' => 'Kyoto Aji Gion',           'prefecture' => 'Kyoto',       'city' => 'Kyoto City',  'category' => 'Japanese'],
            ['restaurant_name' => 'Osaka Dotonbori Kitchen',  'prefecture' => 'Osaka',       'city' => 'Osaka City',  'category' => 'Western'],
            ['restaurant_name' => 'Kobe Western Meriken',     'prefecture' => 'Hyogo',       'city' => 'Kobe',        'category' => 'Western'],
            ['restaurant_name' => 'Hiroshima Okonomishokudo', 'prefecture' => 'Hiroshima',   'city' => 'Hiroshima City','category' => 'Western'],
            ['restaurant_name' => 'Sanuki Udon Konpira',      'prefecture' => 'Kagawa',      'city' => 'Takamatsu',   'category' => 'Japanese'],
            ['restaurant_name' => 'Hakata Motsu Nabe Tenjin', 'prefecture' => 'Fukuoka',     'city' => 'Fukuoka City','category' => 'Hot Pot'],
            ['restaurant_name' => 'Nagasaki Champon Dejima',  'prefecture' => 'Nagasaki',    'city' => 'Nagasaki City','category' => 'Chinese'],
            ['restaurant_name' => 'Kumamoto Basashi Aso',     'prefecture' => 'Kumamoto',    'city' => 'Kumamoto City','category' => 'Japanese'],
            ['restaurant_name' => 'Kagoshima Kurobuta Satsuma','prefecture' => 'Kagoshima',  'city' => 'Kagoshima City','category' => 'Japanese'],
            ['restaurant_name' => 'Okinawa Soba Shuri',       'prefecture' => 'Okinawa',     'city' => 'Naha',        'category' => 'Japanese'],
        ];

        $restaurantIds = [];
            foreach ($restaurants as $r) {

        $email = strtolower(preg_replace('/[^\w]/', '', $r['restaurant_name'])) . '@tabletrip.jp';

        $restaurant = Restaurant::firstOrCreate(
            ['email' => $email],
            [
                'restaurant_name'   => $r['restaurant_name'],
                'phone'             => '000-0000-0000',
                'prefecture'        => $r['prefecture'],
                'city'              => $r['city'],
                'address_line'      => '1-1-1',
                'opening_hours'     => '11:00 - 21:00',
                'description'       => 'A regional restaurant from ' . $r['prefecture'] . ' serving authentic local cuisine.',
                'category_id'       => $categoryIds[$r['category']],
                'reservation_limit' => 20,
                'approval_status'   => 'approved',
                'password'          => bcrypt('password'),
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        );

        $restaurantIds[] = [
            'id' => $restaurant->id,
            'name' => $r['restaurant_name'],
            'prefecture' => $r['prefecture'],
            'category' => $r['category']
        ];
    }
        // 3. Products (20 meal kits)
        $image = 'products/MqFyXlNReIHh3bFg8Dq9Vs2YvvRPfeDKs4QdS9LQ.png';

        $products = [
            ['name' => 'Hokkaido Seafood Rice Bowl Kit',         'price' => 3800, 'description' => 'A luxurious meal kit featuring fresh Hokkaido seafood over seasoned sushi rice.', 'ingredients' => 'Salmon, Sea Urchin, Salmon Roe, Sushi Rice', 'allergens' => 'Seafood', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Tsugaru Apple Pork Saute Kit',           'price' => 2800, 'description' => 'Tender Aomori brand pork raised on local apples, served with a sweet apple glaze.', 'ingredients' => 'Tsugaru Pork, Apple, Onion, Seasoning', 'allergens' => 'Pork', 'badge' => 'Easy', 'difficulty' => 'Easy'],
            ['name' => 'Sendai Thick-Cut Beef Tongue Grill Kit', 'price' => 4200, 'description' => 'Enjoy authentic Sendai-style thick-cut grilled beef tongue at home.', 'ingredients' => 'Beef Tongue, Salt, Lemon, Barley Rice', 'allergens' => 'Beef', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Akita Kiritanpo Hot Pot Kit',            'price' => 3200, 'description' => 'Traditional Akita hot pot with Hinai chicken broth and grilled rice cake skewers.', 'ingredients' => 'Kiritanpo, Hinai Chicken, Burdock, Japanese Parsley, Maitake Mushroom', 'allergens' => 'Chicken, Wheat', 'badge' => 'Kids OK', 'difficulty' => 'Medium'],
            ['name' => 'Yamagata Taro & Beef Hot Pot Kit',       'price' => 2600, 'description' => "Yamagata's iconic autumn hot pot featuring taro and beef in a soy-based broth.", 'ingredients' => 'Taro, Beef, Konjac, Green Onion', 'allergens' => 'Beef', 'badge' => 'Kids OK', 'difficulty' => 'Easy'],
            ['name' => 'Aizu Sauce Katsu Don Kit',               'price' => 2400, 'description' => "Aizu's specialty crispy pork cutlet bowl drizzled with a rich sweet-savory sauce.", 'ingredients' => 'Pork Loin, Breadcrumbs, Egg, Worcestershire Sauce', 'allergens' => 'Pork, Egg, Wheat', 'badge' => 'Easy', 'difficulty' => 'Medium'],
            ['name' => 'Tokyo Edomae Sushi Kit',                 'price' => 5500, 'description' => 'Fresh premium toppings from Nihonbashi for authentic hand-pressed Edomae sushi.', 'ingredients' => 'Tuna, Flounder, Shrimp, Sushi Rice, Wasabi', 'allergens' => 'Seafood', 'badge' => 'Special', 'difficulty' => 'Hard'],
            ['name' => 'Yokohama Chinese Steamed Bun Kit',       'price' => 2200, 'description' => 'Handmade nikuman and xiaolongbao inspired by the authentic recipes of Yokohama Chinatown.', 'ingredients' => 'Bread Flour, Ground Pork, Ginger, Sesame Oil', 'allergens' => 'Pork, Wheat', 'badge' => 'Kids OK', 'difficulty' => 'Medium'],
            ['name' => 'Echizen Grated Radish Soba Kit',         'price' => 1980, 'description' => 'Refreshing 100% buckwheat noodles from Fukui paired with crisp grated daikon radish.', 'ingredients' => 'Echizen Buckwheat Soba, Daikon, Bonito Dashi', 'allergens' => 'Buckwheat', 'badge' => 'Easy', 'difficulty' => 'Easy'],
            ['name' => 'Shinshu Sanzoku Fried Chicken Kit',      'price' => 2600, 'description' => "Nagano's famous mountain bandit chicken: garlicky soy-marinated fried thigh.", 'ingredients' => 'Chicken Thigh, Garlic, Soy Sauce, Potato Starch', 'allergens' => 'Chicken, Wheat', 'badge' => 'Easy', 'difficulty' => 'Medium'],
            ['name' => 'Kyoto Saikyo Miso Grilled Fish Kit',     'price' => 3400, 'description' => 'Elegant marinated fish using Kyoto-style sweet Saikyo miso from a long-established restaurant.', 'ingredients' => 'Black Cod, Saikyo Miso, Mirin, Sake', 'allergens' => 'Fish, Soybean', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Osaka Takoyaki Party Kit',               'price' => 1800, 'description' => 'Authentic takoyaki party kit supervised by a Dotonbori street food vendor.', 'ingredients' => 'Flour, Octopus, Tenkasu, Pickled Ginger, Dashi', 'allergens' => 'Wheat, Seafood, Egg', 'badge' => 'Kids OK', 'difficulty' => 'Easy'],
            ['name' => 'Kobe Beef Stew Kit',                     'price' => 4800, 'description' => 'Rich and hearty beef stew made with premium Kobe beef and red wine reduction.', 'ingredients' => 'Kobe Beef, Potato, Carrot, Red Wine', 'allergens' => 'Beef, Dairy', 'badge' => 'Special', 'difficulty' => 'Medium'],
            ['name' => 'Hiroshima Okonomiyaki Kit',              'price' => 2200, 'description' => 'Hiroshima-style layered okonomiyaki with noodles — a true savory pancake experience.', 'ingredients' => 'Flour, Cabbage, Chinese Noodles, Pork Belly, Egg', 'allergens' => 'Wheat, Egg', 'badge' => 'Kids OK', 'difficulty' => 'Medium'],
            ['name' => 'Sanuki Udon Kit',                        'price' => 1600, 'description' => 'Firm and chewy Sanuki udon noodles delivered with authentic iriko dashi broth.', 'ingredients' => 'Sanuki Udon, Iriko Dashi, Soy Sauce, Green Onion', 'allergens' => 'Wheat', 'badge' => 'Easy', 'difficulty' => 'Easy'],
            ['name' => 'Hakata Offal Hot Pot Kit',               'price' => 3600, 'description' => "Hakata's beloved motsu nabe — rich offal hot pot with your choice of miso or soy broth.", 'ingredients' => 'Beef Offal, Cabbage, Chinese Chive, Champon Noodles', 'allergens' => 'Beef, Wheat', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Nagasaki Champon Noodle Kit',            'price' => 2400, 'description' => 'Hearty Nagasaki champon loaded with seafood and vegetables in a milky pork-bone broth.', 'ingredients' => 'Champon Noodles, Pork, Shrimp, Squid, Cabbage', 'allergens' => 'Wheat, Seafood, Pork', 'badge' => 'Kids OK', 'difficulty' => 'Easy'],
            ['name' => 'Kumamoto Horse Meat Yukhoe Kit',         'price' => 3800, 'description' => 'Fresh Aso-raised horse sashimi served Korean yukhoe-style with sesame and egg yolk.', 'ingredients' => 'Horse Sashimi, Soy Sauce, Sesame Oil, Egg Yolk, Green Onion', 'allergens' => 'Egg', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Kagoshima Kurobuta Shabu-Shabu Kit',     'price' => 4400, 'description' => 'Delicate thin-sliced Kagoshima black pork for a premium shabu-shabu experience.', 'ingredients' => 'Kurobuta Pork Belly, Ponzu, Sesame Sauce, Vegetables', 'allergens' => 'Pork, Sesame', 'badge' => 'Special', 'difficulty' => 'Easy'],
            ['name' => 'Okinawa Rafute Braised Pork Kit',        'price' => 2800, 'description' => 'Slow-braised Okinawan pork belly in awamori and brown sugar for melt-in-your-mouth tenderness.', 'ingredients' => 'Pork Belly, Awamori, Brown Sugar, Soy Sauce', 'allergens' => 'Pork', 'badge' => 'Easy', 'difficulty' => 'Medium'],
        ];

        foreach ($products as $i => $p) {
            $r = $restaurantIds[$i];
            DB::table('products')->insert([
                'name'             => $p['name'],
                'price'            => $p['price'],
                'stock'            => rand(10, 50),
                'serving'          => 2,
                'location'         => $r['prefecture'],
                'restaurant_name'  => $r['name'],
                'restaurant_id'    => $r['id'],
                'rating'           => round(rand(35, 50) / 10, 1),
                'description'      => $p['description'],
                'ingredients'      => $p['ingredients'],
                'allergens'        => $p['allergens'],
                'image'            => $image,
                // 'badge'            => $p['badge'],
                // 'tag'              => null,
                'difficulty_level' => $p['difficulty'],
                'category_id'      => $categoryIds[$r['category']],
                'is_visible'       => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
        }

        $this->command->info('20 products seeded successfully!');

        //     $images = [
        //     'product/meal_kit1.jpeg',
        //     'product/meal_kit2.jpeg',
        //     'product/meal_kit3.jpeg',
        //     'product/meal_kit4.png',
        //     'product/meal_kit5.jpeg',
        // ];

        // $restaurants = range(25, 34);

        // $products = [];

        // for ($i = 0; $i < 20; $i++) {

        //     $restaurantId = $restaurants[array_rand($restaurants)];

        //     // 25を多めに
        //     if ($i < 8) {
        //         $restaurantId = 25;
        //     }

        //     $products[] = [
        //         'name'             => 'Meal Kit ' . ($i + 1),
        //         'price'            => rand(1500, 5000),
        //         'stock'            => rand(5, 50),
        //         'serving'          => rand(1, 4),
        //         'difficulty_level' => ['Easy', 'Medium', 'Hard'][array_rand(['Easy','Medium','Hard'])],
        //         'location'         => 'Japan',
        //         'restaurant_name'  => 'Demo Restaurant',
        //         'rating'           => rand(30, 50) / 10,
        //         'description'      => 'Delicious meal kit for demo.',
        //         'ingredients'      => 'Meat, Vegetables, Sauce',
        //         'allergens'        => 'None',
        //         'image'            => $images[array_rand($images)],
        //         'is_visible'       => 1,
        //         'category_id'      => 1,
        //         'restaurant_id'    => $restaurantId,
        //         'created_at'       => $now,
        //         'updated_at'       => $now,
        //     ];
        // }

        // DB::table('products')->insert($products);
    }
}