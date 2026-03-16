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
    Schema::create('restaurants', function (Blueprint $table) {
        $table->id();         
        $table->string('password');
        $table->string('restaurant_name');
        $table->string('prefecture');
        $table->string('city');
        $table->string('address_line');
        $table->string('full_address');
        $table->string('opening_hours');
        $table->text('description'); 
        $table->string('chef');
        $table->string('email')->unique();
        $table->string('tel'); 
        $table->integer('category_id'); 
        $table->integer('reservation_limit');
        $table->string('approval_status');
        $table->timestamp('approved_at')->nullable();
        $table->timestamps(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
