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
        // Drop tabel yang ada jika ada masalah struktur
        if (Schema::hasTable('mentoring_feedback')) {
            Schema::dropIfExists('mentoring_feedback');
        }

        // Buat tabel dengan struktur yang benar
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
    }
};
