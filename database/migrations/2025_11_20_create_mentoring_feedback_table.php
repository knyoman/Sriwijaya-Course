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
        Schema::create('mentoring_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_id');
            $table->unsignedBigInteger('pelajar_id');
            $table->integer('rating')->nullable(); // 1-5 bintang
            $table->text('feedback_text')->nullable();
            $table->json('benefits')->nullable(); // Array of selected benefits
            $table->timestamps();

            $table->foreign('mentoring_id')->references('id')->on('mentoring')->onDelete('cascade');
            $table->foreign('pelajar_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->unique(['mentoring_id', 'pelajar_id']);
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
