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
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('mentoring', 'topik')) {
                $table->string('topik')->nullable()->after('jam');
            }
            if (!Schema::hasColumn('mentoring', 'durasi')) {
                $table->integer('durasi')->nullable()->after('topik');
            }
            if (!Schema::hasColumn('mentoring', 'jumlah_peserta')) {
                $table->integer('jumlah_peserta')->nullable()->after('durasi');
            }
            if (!Schema::hasColumn('mentoring', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('jumlah_peserta');
            }

            // Update enum status jika diperlukan
            if (Schema::hasColumn('mentoring', 'status')) {
                $table->enum('status', ['Belum', 'Sedang Berlangsung', 'Sudah'])->default('Belum')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentoring', function (Blueprint $table) {
            $table->dropColumn(['topik', 'durasi', 'jumlah_peserta', 'deskripsi']);
        });
    }
};
