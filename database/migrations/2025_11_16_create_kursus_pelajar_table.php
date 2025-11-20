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
        Schema::create('kursus_pelajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_id');
            $table->unsignedBigInteger('pelajar_id');
            $table->enum('status', ['terdaftar', 'aktif', 'selesai', 'dibatalkan'])->default('terdaftar');
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            $table->foreign('pelajar_id')->references('id')->on('pengguna')->onDelete('cascade');

            // Unique constraint: satu pelajar hanya bisa daftar sekali per kursus
            $table->unique(['kursus_id', 'pelajar_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_pelajar');
    }
};
