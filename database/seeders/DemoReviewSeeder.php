<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Review;

class DemoReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();
        $restaurants = Restaurant::all();
        $products = Product::all();

        $comments = [
            'Amazing food and great service!',
            'The meal kit was easy to cook and delicious.',
            'Not bad, but delivery was a bit late.',
            'I loved the flavors, will order again.',
            'The portion size was small.',
            'Absolutely fantastic experience!',
            'Food quality was disappointing.',
            'Great value for money.',
            'Packaging was neat and secure.',
            'I had an issue with my order.',
            'Super tasty and fresh ingredients!',
            'Will definitely recommend to friends.',
            'The taste was okay, nothing special.',
            'Service could be improved.',
            'Best meal kit I have tried so far!',

            // NGワード（hidden確認用）
            'This is stupid service.',
            'I hate this product.',
        ];

        foreach ($users as $user) {

            $reviewCount = rand(1, 4);

            for ($i = 0; $i < $reviewCount; $i++) {

                $type = rand(0, 1); // 0 = restaurant / 1 = product
                $comment = $comments[array_rand($comments)];

                if ($type === 0) {
                    // 🍽 Restaurant Review
                    $restaurant = $restaurants->random();

                    $review = Review::create([
                        'user_id' => $user->id,
                        'restaurant_id' => $restaurant->id,
                        'product_id' => null,
                        'rating' => rand(1, 5),
                        'comment' => $comment,
                    ]);

                } else {
                    // 📦 Product Review
                    $product = $products->whereNotNull('restaurant_id')->random();

                    $review = Review::create([
                        'user_id' => $user->id,
                        'restaurant_id' => $product->restaurant_id,
                        'product_id' => $product->id,
                        'rating' => rand(1, 5),
                        'comment' => $comment,
                    ]);
                }

                // ⭐ flaggedも作る（後から上書き）
                if (rand(1, 10) <= 2) {
                    $review->update([
                        'status' => 'flagged'
                    ]);
                }
            }
        }
    }
}
