<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
