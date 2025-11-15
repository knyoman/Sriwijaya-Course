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
        Schema::create('soal_quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->longText('pertanyaan');
            $table->longText('pilihan_a');
            $table->longText('pilihan_b');
            $table->longText('pilihan_c');
            $table->longText('pilihan_d');
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);
            $table->integer('urutan')->default(1);
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quiz')->onDelete('cascade');
            $table->index('quiz_id');
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_quiz');
    }
};
