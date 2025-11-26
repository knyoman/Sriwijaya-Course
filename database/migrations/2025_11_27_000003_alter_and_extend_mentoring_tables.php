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
        // Alter mentoring table
        Schema::table('mentoring', function (Blueprint $table) {
            if (!Schema::hasColumn('mentoring', 'topik')) {
                $table->string('topik')->nullable()->after('jam');
            }
            if (!Schema::hasColumn('mentoring', 'durasi')) {
                $table->integer('durasi')->nullable()->after('topik');
            }

            // Update enum status
            try {
                $table->enum('status', ['Belum', 'Sedang Berlangsung', 'Sudah'])->default('Belum')->change();
            } catch (\Exception $e) {
                // Skip jika ada error
            }
        });

        // Create mentoring feedback table dengan struktur yang benar
        Schema::create('mentoring_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_id');
            $table->unsignedBigInteger('pelajar_id');
            $table->text('feedback_text')->nullable();
            $table->integer('rating')->nullable();
            $table->json('benefits')->nullable();
            $table->timestamps();

            $table->foreign('mentoring_id')->references('id')->on('mentoring')->onDelete('cascade');
            $table->foreign('pelajar_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring_feedback');

        Schema::table('mentoring', function (Blueprint $table) {
            if (Schema::hasColumn('mentoring', 'topik')) {
                $table->dropColumn('topik');
            }
            if (Schema::hasColumn('mentoring', 'durasi')) {
                $table->dropColumn('durasi');
            }
        });
    }
};
