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
        Schema::table('training_prices', function (Blueprint $table) {
            $table->string('place')->after('city_id')->nullable();
            $table->date('start_date')->after('place')->nullable();
            $table->date('end_date')->after('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_prices', function (Blueprint $table) {
            $table->dropColumn(['place', 'start_date', 'end_date']);
        });
    }
};
