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
        Schema::table('articles', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['user_id']);

            // Tambah foreign key baru dengan onDelete set null
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete(); // Laravel 7+ bisa pakai ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            });
        });
    }
};
