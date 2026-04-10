<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('meal_kit_id')->constrained(); 
            $table->foreignId('restaurant_id');
            $table->integer('total_price');
            $table->string('status');
            $table->timestamps();
        });

<<<<<<< Updated upstream
        $table->foreignId('user_id');

        $table->foreignId('restaurant_id');

        $table->integer('total_price');

        $table->string('status');

        $table->timestamps();

    });
}
=======
       
        Schema::enableForeignKeyConstraints();
    }
>>>>>>> Stashed changes

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orders');
    }
};
