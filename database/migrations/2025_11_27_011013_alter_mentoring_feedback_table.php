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
        Schema::table('mentoring_feedback', function (Blueprint $table) {
            // Ubah 'feedback' menjadi 'feedback_text' jika kolom masih 'feedback'
            if (Schema::hasColumn('mentoring_feedback', 'feedback')) {
                $table->renameColumn('feedback', 'feedback_text');
            }

            // Tambah kolom 'benefits' jika belum ada
            if (!Schema::hasColumn('mentoring_feedback', 'benefits')) {
                $table->json('benefits')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentoring_feedback', function (Blueprint $table) {
            // Rollback: ubah 'feedback_text' kembali ke 'feedback'
            if (Schema::hasColumn('mentoring_feedback', 'feedback_text')) {
                $table->renameColumn('feedback_text', 'feedback');
            }

            // Hapus kolom 'benefits'
            if (Schema::hasColumn('mentoring_feedback', 'benefits')) {
                $table->dropColumn('benefits');
            }
        });
    }
};
