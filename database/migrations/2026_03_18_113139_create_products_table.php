<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // キットの名前
            $table->integer('price');           // 価格
            $table->string('location');         // 場所 (例: 北海道、イタリア)
            $table->string('restaurant_name');  // レストランの名称
            $table->decimal('rating', 3, 1)->default(0); // 評価
            $table->text('description');        // 商品説明
            $table->text('ingredients');        // 原材料
            $table->string('allergens');        // アレルギー情報 (例: 小麦、卵、乳成分)
            $table->string('image')->nullable(); // 商品画像パス
            $table->foreignId('category_id')->constrained(); // カテゴリID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
