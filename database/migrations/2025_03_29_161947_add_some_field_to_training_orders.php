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
        Schema::table('training_orders', function (Blueprint $table) {
            $table->string('name')->after('payment_status');
            $table->string('email')->after('name');
            $table->string('phone')->after('email');
            $table->text('notes')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'notes']);
        });
    }
};
