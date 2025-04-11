<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE training_orders
            MODIFY status ENUM('pending', 'verifying', 'processing', 'completed', 'cancelled')
            DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Rollback tanpa 'verifying'
        DB::statement("ALTER TABLE training_orders
            MODIFY status ENUM('pending', 'processing', 'completed', 'cancelled')
            DEFAULT 'pending'");
    }
};
