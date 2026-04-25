<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Purchased;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;


class DemoOrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();
        $products = Product::all();

        foreach ($products as $product) {
            DB::table('meal_kits')->updateOrInsert(
                ['id' => $product->id],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        foreach ($users as $user) {
            $orderCount = rand(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                $orderDate = Carbon::now()->subDays(rand(0, 30));
                $mainProduct = $products->random();

                $order = Order::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $mainProduct->restaurant_id ?? 1,
                    'meal_kit_id' => $mainProduct->id,
                    'total_price' => 0,
                    'status' => ['pending', 'shipped', 'delivered'][rand(0, 2)],
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                $total = 0;
                $itemCount = rand(1, 3);

                for ($j = 0; $j < $itemCount; $j++) {
                    $product = $j === 0 ? $mainProduct : $products->random();
                    $qty = rand(1, 2);

                    Purchased::create([
                        'order_id' => $order->id,
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price_at_purchased' => $product->price,
                        'ordered_at' => $orderDate,
                    ]);

                    $total += $product->price * $qty;
                }

                $order->update([
                    'total_price' => $total,
                ]);
            }
        }
    }
}
