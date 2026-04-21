<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchased', function (Blueprint $table) {
            $table->renameColumn('meal_kit_id', 'product_id');
        });

        Schema::table('favorite_kits', function (Blueprint $table) {
            $table->renameColumn('meal_kit_id', 'product_id');
        });
    }

    public function down(): void
    {
        Schema::table('purchased', function (Blueprint $table) {
            $table->renameColumn('product_id', 'meal_kit_id');
        });

        Schema::table('favorite_kits', function (Blueprint $table) {
            $table->renameColumn('product_id', 'meal_kit_id');
        });
    }
};
