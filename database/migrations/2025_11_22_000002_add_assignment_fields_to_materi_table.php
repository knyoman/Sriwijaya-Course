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
        Schema::table('materi', function (Blueprint $table) {
            $table->boolean('has_tugas')->default(false)->after('durasi_menit');
            $table->text('tugas_instruksi')->nullable()->after('has_tugas');
            $table->text('tugas_soal')->nullable()->after('tugas_instruksi');
            $table->dateTime('tugas_deadline')->nullable()->after('tugas_soal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            if (Schema::hasColumn('materi', 'has_tugas')) {
                $table->dropColumn('has_tugas');
            }
            if (Schema::hasColumn('materi', 'tugas_instruksi')) {
                $table->dropColumn('tugas_instruksi');
            }
            if (Schema::hasColumn('materi', 'tugas_soal')) {
                $table->dropColumn('tugas_soal');
            }
            if (Schema::hasColumn('materi', 'tugas_deadline')) {
                $table->dropColumn('tugas_deadline');
            }
        });
    }
};
