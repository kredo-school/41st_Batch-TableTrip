<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string('restaurant_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->string('prefecture');
            $table->string('city');
            $table->string('address_line');

            $table->text('opening_hours')->nullable();
            $table->text('description')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('reservation_limit')->nullable();

            $table->string('approval_status')->default('draft');

            $table->string('status')->default('published');

            $table->timestamp('approved_at')->nullable();

            $table->string('password');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
