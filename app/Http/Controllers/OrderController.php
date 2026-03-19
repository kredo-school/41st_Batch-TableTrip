<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class OrderController extends Controller
{
    public function showDetails()
    {
        $product = Product::first();

        return view('products.order_details', compact('product'));
    }

    public function create()
    {
        // resources/views/products/create.blade.php を表示する
        return view('products.create');
    }

    public function store(Request $request)
    {
        // ① 入力チェック（imageを追加）
        $request->validate([
            'name' => 'required',
            'restaurant_name' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像の形式とサイズ制限
        ]);

        // --- 画像の保存処理を追加 ---
        $imagePath = null;
        if ($request->hasFile('image')) {
            // storage/app/public/products フォルダに保存
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // ② データベースに保存する
        Product::create([
            'name' => $request->name,
            'category_id' => 1,
            'restaurant_name' => $request->restaurant_name,
            'location' => $request->location,
            'price' => $request->price,
            'ingredients' => $request->ingredients ?? 'No data',
            'allergens' => $request->allergens,
            'description' => $request->description,
        ]);

        // ③ 保存が終わったら、一覧画面（または詳細画面）に戻す
        return redirect()->route('products.index')->with('success', 'Product registered successfully!');
    }
}