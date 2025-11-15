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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_id');
            $table->string('judul_materi');
            $table->longText('deskripsi')->nullable();
            $table->integer('urutan')->default(1);
            $table->enum('tipe_konten', ['video', 'dokumen', 'kuis', 'live_session'])->default('video');
            $table->string('url_konten')->nullable();
            $table->integer('durasi_menit')->nullable();
            $table->timestamps();

            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            $table->index('kursus_id');
            $table->index('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
