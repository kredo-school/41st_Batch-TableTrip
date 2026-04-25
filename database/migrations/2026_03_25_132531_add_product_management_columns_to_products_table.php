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
        // Schema::table('products', function (Blueprint $table) {
        //     $table->integer('stock')->default(0)->after('price');
        //     $table->integer('serving')->default(1)->after('stock');
        //     $table->string('difficulty_level')->nullable()->after('serving');
        //     $table->boolean('is_visible')->default(true)->after('image');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                // 'stock',
                // 'serving',
                // 'difficulty_level',
                // 'is_visible',
            ]);
        });
    }
};
