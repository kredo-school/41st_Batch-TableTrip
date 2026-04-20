<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('purchased', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id'); 
        $table->integer('meal_kit_id');
        $table->integer('quantity');
        $table->integer('price_at_purchased');
        $table->timestamp('ordered_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased');
    }
};
