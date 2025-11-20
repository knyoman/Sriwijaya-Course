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
        Schema::create('mentoring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajar_id');
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('status', ['Belum', 'Sudah'])->default('Belum');
            $table->string('zoom_link')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('pengajar_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring');
    }
};
