<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update data lama yang kosong dengan nilai default
        DB::table('kursus_pelajar')
            ->whereNull('metode_pembayaran')
            ->update([
                'metode_pembayaran' => 'Transfer Bank',
            ]);

        DB::table('kursus_pelajar')
            ->whereNull('status_pembayaran')
            ->update([
                'status_pembayaran' => 'lunas',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada yang perlu di-reverse
    }
};
