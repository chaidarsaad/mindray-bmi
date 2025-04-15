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
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
