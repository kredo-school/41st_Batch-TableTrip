<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\PointHistory;

class DemoPointHistorySeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            PointHistory::firstOrCreate([
                'user_id' => $order->user_id,
                'description' => 'Order #' . $order->id,
            ], [
                'points' => floor($order->total_price / 100),
                'type' => 'purchase',
            ]);
        }
    }
}
