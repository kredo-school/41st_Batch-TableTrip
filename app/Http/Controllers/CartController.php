<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchased;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('products.cart', compact('cart'));
    }

    public function add(Request $request)
    {
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
        $cart  = session('cart', []);
        $total = array_sum(array_map(fn($i) => $i['product']['price'] * $i['quantity'], $cart));
        return view('products.confirm', compact('cart', 'total'));
    }

    public function thanks()
    {
        $cart    = session('cart', []);
        $orderId = 'TRP-' . now()->format('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        if (Auth::check() && count($cart) > 0) {
            foreach ($cart as $id => $item) {
                Purchased::create([
                    'user_id'            => Auth::id(),
                    'meal_kit_id'        => $id,
                    'quantity'           => $item['quantity'],
                    'price_at_purchased' => $item['product']['price'],
                    'ordered_at'         => Carbon::now(),
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
