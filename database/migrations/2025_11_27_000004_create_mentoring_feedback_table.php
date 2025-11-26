<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * NOTE: Tabel mentoring_feedback sudah dibuat di migration 2025_11_27_000003
     * Migration ini dibuat duplikat dan sudah di-handle di migration 000003
     */
    public function up(): void
    {
        // No-op migration - tabel sudah dibuat di 2025_11_27_000003
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op migration
    }
};
