<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('price');
            $table->integer('stock')->default(0);
            $table->integer('serving')->nullable();
            $table->string('difficulty_level')->nullable();

            $table->string('location')->nullable();
            $table->string('restaurant_name')->nullable();

            $table->decimal('rating', 2, 1)->nullable();

            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('allergens')->nullable();

            $table->string('image')->nullable();

            $table->boolean('is_visible')->default(true);

            $table->foreignId('category_id')->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('badge')->nullable();
            $table->string('tag')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
