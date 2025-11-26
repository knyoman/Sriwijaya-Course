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
            // Tambahkan kolom kursus_id jika belum ada
            if (!Schema::hasColumn('mentoring', 'kursus_id')) {
                $table->unsignedBigInteger('kursus_id')->nullable()->after('pengajar_id');
                $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
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
        });
    }
};
