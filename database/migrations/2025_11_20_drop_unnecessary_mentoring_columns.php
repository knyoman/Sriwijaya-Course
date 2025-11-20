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
        Schema::table('mentoring', function (Blueprint $table) {
            // Hapus kolom yang tidak dibutuhkan
            if (Schema::hasColumn('mentoring', 'jumlah_peserta')) {
                $table->dropColumn('jumlah_peserta');
            }
            if (Schema::hasColumn('mentoring', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentoring', function (Blueprint $table) {
            $table->integer('jumlah_peserta')->nullable();
            $table->text('deskripsi')->nullable();
        });
    }
};
