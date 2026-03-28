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
        // If the table already exists, drop it to start fresh
        Schema::dropIfExists('inquiry');

        Schema::create('inquiry', function (Blueprint $table) {
            $table->id(); // Add the primary key
            $table->string('thread_id')->nullable(); 
            $table->unsignedBigInteger('sender_id'); 
            $table->string('sender_type');
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('recipient_type')->nullable();        
            $table->string('subject')->default('Inquiry');
            $table->text('message');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry');
    }
};