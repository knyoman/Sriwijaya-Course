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
            // Tambahkan kolom kursus_id
            if (!Schema::hasColumn('mentoring', 'kursus_id')) {
                $table->unsignedBigInteger('kursus_id')->nullable()->after('pengajar_id');
                $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            }

            // Tambahkan kolom baru
            if (!Schema::hasColumn('mentoring', 'topik')) {
                $table->string('topik')->nullable()->after('jam');
            }
            if (!Schema::hasColumn('mentoring', 'durasi')) {
                $table->integer('durasi')->nullable()->after('topik');
            }

            // Ubah enum status
            try {
                $table->enum('status', ['Belum', 'Sedang Berlangsung', 'Sudah'])->default('Belum')->change();
            } catch (\Exception $e) {
                // Skip jika ada error
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentoring', function (Blueprint $table) {
            if (Schema::hasColumn('mentoring', 'kursus_id')) {
                $table->dropForeign(['kursus_id']);
                $table->dropColumn('kursus_id');
            }
            if (Schema::hasColumn('mentoring', 'topik')) {
                $table->dropColumn('topik');
            }
            if (Schema::hasColumn('mentoring', 'durasi')) {
                $table->dropColumn('durasi');
            }
        });
    }
};
