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
        Schema::create('training_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_order_id')->constrained('training_orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('training_price_id')->constrained('training_prices')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_order_details');
    }
};
