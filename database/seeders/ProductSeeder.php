<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; 

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Journey Kit: Hokkaido Seafood',
            'price' => 8500,
            'location' => 'Hokkaido, Japan',
            'restaurant_name' => 'Sapporo Shiosai',
            'rating' => 4.8,
            'description' => 'A luxurious meal kit featuring fresh Hokkaido seafood.',
            'ingredients' => 'Crab, Salmon Roe, Scallops, Special Soy Sauce',
            'allergens' => 'Wheat, Crab, Soy',
            'category_id' => 1, 
            'image' => 'hokkaido_kit.jpg'
        ]);
    }
}
