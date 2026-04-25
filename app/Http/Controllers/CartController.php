<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchased;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Notification;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('products.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($request->product_id);
        $cart = session('cart', []);

        $id = $product->id;
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product'  => $product->toArray(),
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return back();
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->product_id;

        if (isset($cart[$id])) {
            $qty = (int) $request->quantity;
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $qty;
            }
            session(['cart' => $cart]);
        }

        return $request->redirect === 'confirm'
            ? redirect()->route('cart.confirm')
            : back();
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->product_id]);
        session(['cart' => $cart]);

        return $request->redirect === 'confirm'
            ? redirect()->route('cart.confirm')
            : back();
    }

        public function confirm()
    {
        $cart          = session('cart', []);
        $total         = array_sum(array_map(fn($i) => $i['product']['price'] * $i['quantity'], $cart));
        $user          = auth()->user();
        $paymentMethod = $user ? PaymentMethod::where('user_id', $user->id)->where('is_default', true)->first() : null;
        return view('products.confirm', compact('cart', 'total', 'user', 'paymentMethod'));
    }

    public function thanks()
    {
        $cart    = session('cart', []);
        $orderId = 'TRP-' . now()->format('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        if (Auth::check() && count($cart) > 0) {


        // カート全体の合計金額
        $totalPrice = collect($cart)->sum(function ($item) {
            return $item['quantity'] * $item['product']['price'];
        });


        $firstItem = collect($cart)->first();
        $restaurantId = $firstItem['product']['restaurant_id'] ?? null;
        $productId = $firstItem['product']['id'] ?? null;

        // orders に1件作成
        $order = Order::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurantId,
            'product_id'    => $productId,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

            foreach ($cart as $id => $item) {
                Purchased::create([
                    'order_id'            => $order->id,
                    'user_id'            => Auth::id(),
                    'product_id'        => $id,
                    'quantity'           => $item['quantity'],
                    'price_at_purchased' => $item['product']['price'],
                    'ordered_at'         => Carbon::now(),
                ]);

                $productName = $item['product']['name'] ?? 'your recent purchase';

                Notification::create([
                    'recipient_id'       => Auth::id(),
                    'recipient_type'     => User::class,
                    'title'              => 'How was your order? Leave a review!',
                    'message'            => "Thank you for purchasing \"{$productName}\"! We hope you enjoyed it. Share your experience by leaving a review — your feedback helps other customers and supports our restaurant partners.",
                    'target_type'        => Product::class,
                    'target_id'          => $id,
                    'is_action_required' => true,
                    'is_completed'       => false,
                ]);
            }
            session(['last_order' => ['id' => $orderId, 'items' => $cart, 'ordered_at' => now()->format('Y/m/d')]]);
        }

        session()->forget('cart');

        return view('products.thanks', compact('orderId', 'cart'));
    }

    public function orderDetails()
    {
        $order = session('last_order');
        if (!$order) {
            return redirect()->route('purchased.index');
        }
        return view('products.order_details', compact('order'));
    }
}
