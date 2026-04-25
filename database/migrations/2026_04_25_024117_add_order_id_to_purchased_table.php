<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchased', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->after('id')
                ->constrained('orders')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('purchased', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
    }
};
