<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\AbleImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;

class PageManagementController extends Controller
{
    public function index(){
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);
        $categories = Category::orderBy('name')->get();

        return view('restaurant-owners.page-management.basic-info', compact('restaurant', 'categories'));
    }

    public function updateBasicInfo(Request $request){

        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);

        $validator = Validator::make($request->all(), [
            'restaurant_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'prefecture' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'opening_hours' => 'required|string|max:255',
            'chef' => 'nullable|string|max:255',
            'action' => 'required|in:draft,publish',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

         $status = $request->action === 'publish' ? 'published' : 'draft';

        $restaurant->update([
        'restaurant_name' => $request->restaurant_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'prefecture' => $request->prefecture,
        'city' => $request->city,
        'address_line' => $request->address_line,
        'opening_hours' => $request->opening_hours,
        'chef' => $request->chef,
        'description' => $request->description,
        'category_id' => $request->category_id,
        'status' => $status, 
    ]);


        return redirect()->back()->with('success', 'Basic information updated successfully.');
    }

    public function image(){
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::with('images')->findOrFail($owner->id);

        return view('restaurant-owners.page-management.image', compact('restaurant'));
    }

    public function updateImage(Request $request){
        // Image upload logic will go here
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);

        $request->validate([
            'hero_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try{
            $images = [
                'hero_image' => 1,
                'gallery_image1' => 2,
                'gallery_image2' => 3
            ];

             foreach ($images as $inputName => $displayOrder) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);

                $path = $file->store('restaurant-images', 'public');

                $existingImage = AbleImage::where('target_type', 'restaurant')
                    ->where('target_id', $restaurant->id)
                    ->where('display_order', $displayOrder)
                    ->first();

                if ($existingImage) {
                    if (Storage::disk('public')->exists($existingImage->image_url)) {
                        Storage::disk('public')->delete($existingImage->image_url);
                    }

                    $existingImage->update([
                        'image_url' => $path,
                    ]);
                } else {
                    AbleImage::create([
                        'target_type'   => 'restaurant',
                        'target_id'     => $restaurant->id,
                        'image_url'     => $path,
                        'display_order' => $displayOrder,
                    ]);
                }
            }
        }
        DB::commit();
        return redirect()->back()->with('success', 'Images updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating images.');
        }
    }

    public function menu(){

        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);

        $menus = $restaurant->menus()->paginate(5);

        return view('restaurant-owners.page-management.menu', compact('restaurant', 'menus'));
    }

    public function storeMenu(Request $request)
    {
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'addMenuModal');
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu-images', 'public');
        }

        $restaurant->menus()->create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Menu added successfully.');
    }   
    
    public function updateMenu(Request $request, $id){
       
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'editMenuModal-' . $id);
        }

        $menu = $restaurant->menus()->findOrFail($id);

        if ($request->hasFile('image')) {
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $menu->image = $request->file('image')->store('menu-images', 'public');
        }

        $menu->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Menu updated successfully.');
    }

     public function deleteMenu($id){
       
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);
        $menu = $restaurant->menus()->findOrFail($id);

        if ($menu->image && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully.');
    }

    public function preview(){
        $owner = Auth::guard('restaurant')->user();
        $restaurant = Restaurant::findOrFail($owner->id);
        $menus = $restaurant->menus()->get();
        $products = Product::where('restaurant_id', $restaurant->id)->get();

        return view('restaurant-owners.page-management.preview', compact('restaurant', 'menus', 'products'));
    }
}