<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\AbleImage;
use App\Models\Product;
;
class ProductController extends Controller
{
    public function index(Request $request){

        $categories = Category::orderBy('name')->get();

        $owner = Auth::guard('restaurant')->user();

        $query = Product::where('restaurant_id',$owner->id);

        if($request->filled('search')){
            $keyword = trim($request->search);
            $query->where('name','like','%'.$keyword.'%');
        }

        if ($request->filled('status')) {

            switch ($request->status) {

                case 'active':
                    $query->where('stock', '>', 5)
                        ->where('is_visible', true);
                    break;

                case 'low_stock':
                    $query->where('stock', '<=', 5)
                        ->where('stock', '>', 0)
                        ->where('is_visible', true);
                    break;

                case 'sold_out':
                    $query->where('stock', 0)
                        ->where('is_visible', true);
                    break;

                case 'hide':
                    $query->where('is_visible', false);
                    break;
            }
        }

        if($request->filled('category_id')){
            $query->where('category_id',$request->category_id);
        }

        $products = $query
        ->orderBy('updated_at','desc')
        ->orderBy('created_at','desc')
        ->paginate(5)
        ->withQueryString(); //paginateしても検索条件保持

        return view('restaurant-owners.meal_kits.index',compact('categories','products'));
    }

    public function toggleVisibility($id)
    {
        $product = Product::findOrFail($id);
        $product->is_visible = !$product->is_visible;
        $product->save();

        return back();
    }

    public function create(){

        $categories = Category::orderBy('name')->get();

        return view('restaurant-owners.meal_kits.add',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:225',
            'price'=>'required|integer|min:0',
            'stock'=>'required|integer|min:0',
            'serving'=>'required|integer|min:1',
            'difficulty_level' => 'required|string|max:225',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'allergens' => 'nullable|array',
            'allergens.*' => 'string|max:50',
            'other_allergen' => 'nullable|string|max:225',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

         DB::beginTransaction();

         try{
             $owner = Auth::guard('restaurant')->user();

            $allergens = $request->allergens ?? [];

            if ($request->filled('other_allergen')) {
                $allergens[] = $request->other_allergen;
            }

            $product = new Product();
            $product->restaurant_id = $owner->id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->serving = $request->serving;
            $product->difficulty_level = $request->difficulty_level;
            $product->location = $owner->prefecture;
            $product->restaurant_name =$owner->restaurant_name;
            $product->rating = 0.0;
            $product->description = $request->description;
            $product->ingredients = $request->ingredients;
            $product->allergens = implode(', ', $allergens);
            $product->is_visible = 1;
            $product->category_id = $request->category_id;
            $product->image = null;

            $product->save();

            $displayOrder = 1;
        
         // 2. Main image 保存
        if ($request->hasFile('main_image')) {
            $mainPath = $request->file('main_image')->store('product', 'public');

            AbleImage::create([
                'target_id' => $product->id,
                'target_type' => 'product',
                'image_url' => $mainPath,
                'display_order' => $displayOrder,
            ]);

            // 既存imageカラムにも入れておく
            $product->image = $mainPath;
            $product->save();

            $displayOrder++;
        }

        // 3. Additional images 保存
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('product', 'public');

                AbleImage::create([
                    'target_id' => $product->id,
                    'target_type' => 'product',
                    'image_url' => $path,
                    'display_order' => $displayOrder,
                ]);

                $displayOrder++;
            }
        }

        DB::commit();

        return redirect()->route('owner.products')->with('success', 'Product added successfully.');

        }catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to add product.');
        }
    }

    public function edit($id){

        $owner = Auth::guard('restaurant')->user();

        $product = Product::findOrFail($id);

        abort_if($product->restaurant_id !== $owner->id, 403);

        $categories = Category::orderBy('name')->get();


        return view('restaurant-owners.meal_kits.edit',compact('product','categories'));
    }

    public function destroyImage($id)
    {
        $owner = Auth::guard('restaurant')->user();

        $image = AbleImage::findOrFail($id);
        $product = Product::findOrFail($image->target_id);

        abort_if($image->target_type !== 'product', 404);
        abort_if($product->restaurant_id !== $owner->id, 403);

        if ($image->image_url && Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }

        $image->delete();

        return response()->json([
            'message' => 'Image deleted successfully.'
        ]);
    }

    public function update(Request $request,$id){
        
        $validator = $request->validate([
            'name' => 'required|string|max:225',
            'price'=>'required|integer|min:0',
            'stock'=>'required|integer|min:0',
            'serving'=>'required|integer|min:1',
            'difficulty_level' => 'required|string|max:225',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'allergens' => 'nullable|array',
            'allergens.*' => 'string|max:50',
            'other_allergen' => 'nullable|string|max:225',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',         
        ]);

        $product = Product::findOrFail($id);

        if(Auth::guard('restaurant')->id() !== $product->restaurant_id){
            return redirect()->route('owner.products');
        }

         DB::beginTransaction();

         try{
             $owner = Auth::guard('restaurant')->user();

            $allergens = $request->allergens ?? [];

            if ($request->filled('other_allergen')) {
                $allergens[] = $request->other_allergen;
            }

            $product->restaurant_id = $owner->id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->serving = $request->serving;
            $product->difficulty_level = $request->difficulty_level;
            $product->location = $owner->prefecture;
            $product->restaurant_name =$owner->restaurant_name;
            $product->rating = 0.0;
            $product->description = $request->description;
            $product->ingredients = $request->ingredients;
            $product->allergens = implode(', ', $allergens);
            $product->is_visible = 1;
            $product->category_id = $request->category_id;
            

            $product->save();

            $displayOrder = 1;
        
         // main image が送られた時だけ差し替え
        if ($request->hasFile('main_image')) {
            // products.image の古いファイル削除
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // able_images の main image(display_order = 1) を取得
            $mainImage = AbleImage::where('target_type', 'product')
                ->where('target_id', $product->id)
                ->where('display_order', 1)
                ->first();

            // able_images 側の古いファイル削除
            if ($mainImage && $mainImage->image_url && Storage::disk('public')->exists($mainImage->image_url)) {
                Storage::disk('public')->delete($mainImage->image_url);
            }

            $mainPath = $request->file('main_image')->store('product', 'public');

            // products テーブル更新
            $product->image = $mainPath;
            $product->save();

            // able_images テーブル更新 or 作成
            if ($mainImage) {
                $mainImage->image_url = $mainPath;
                $mainImage->save();
            } else {
                AbleImage::create([
                    'target_id' => $product->id,
                    'target_type' => 'product',
                    'image_url' => $mainPath,
                    'display_order' => 1,
                ]);
            }
        }

        // additional images は追加だけ
        if ($request->hasFile('additional_images')) {
            $displayOrder = AbleImage::where('target_type', 'product')
                ->where('target_id', $product->id)
                ->max('display_order') ?? 1;

            $displayOrder++;

            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('product', 'public');

                AbleImage::create([
                    'target_id' => $product->id,
                    'target_type' => 'product',
                    'image_url' => $path,
                    'display_order' => $displayOrder,
                ]);

                $displayOrder++;
            }
        }

        DB::commit();

        return redirect()->route('owner.products')->with('success', 'Product edited successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage());
    }
    }

   public function show($id)
    {
        $product = Product::findOrFail($id);

        $images = AbleImage::where('target_type', 'product')
            ->where('target_id', $product->id)
            ->orderBy('display_order')
            ->get();

        return view('restaurant-owners.meal_kits.details', compact('product', 'images'));
    }
}
