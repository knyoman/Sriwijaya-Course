<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel forum diskusi per kursus
        Schema::create('diskusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_id');
            $table->string('judul');
            $table->longText('konten');
            $table->unsignedBigInteger('pembuat_id');
            $table->integer('jumlah_balasan')->default(0);
            $table->timestamps();

            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            $table->foreign('pembuat_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->index('kursus_id');
            $table->index('pembuat_id');
        });

        // Tabel balasan/komentar pada diskusi
        Schema::create('balasan_diskusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diskusi_id');
            $table->unsignedBigInteger('pembuat_id');
            $table->longText('konten');
            $table->timestamps();

            $table->foreign('diskusi_id')->references('id')->on('diskusi')->onDelete('cascade');
            $table->foreign('pembuat_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->index('diskusi_id');
            $table->index('pembuat_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balasan_diskusi');
        Schema::dropIfExists('diskusi');
    }
};
