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
        Schema::create('kursus', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama kursus
            $table->string('slug')->unique(); // URL-friendly name
            $table->text('deskripsi'); // Deskripsi kursus
            $table->decimal('harga', 10, 2); // Harga kursus
            $table->string('image')->nullable(); // URL gambar
            $table->unsignedBigInteger('pengajar_id'); // ID pengajar
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            $table->text('konten')->nullable(); // Konten/materi kursus
            $table->integer('durasi_jam')->default(0); // Durasi dalam jam
            $table->integer('jumlah_pelajar')->default(0); // Jumlah pelajar terdaftar
            $table->timestamps();

            // Foreign key
            $table->foreign('pengajar_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus');
    }
};
