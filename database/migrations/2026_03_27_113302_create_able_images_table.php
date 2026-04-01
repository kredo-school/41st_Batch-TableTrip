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
        Schema::create('able_images', function (Blueprint $table) {
            $table->id();
            // これが超重要（ポリモーフィック）
            $table->unsignedBigInteger('target_id');
            $table->string('target_type');

            $table->string('image_url');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('able_images');
    }
};
