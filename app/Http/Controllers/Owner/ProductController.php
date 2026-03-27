<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
}
