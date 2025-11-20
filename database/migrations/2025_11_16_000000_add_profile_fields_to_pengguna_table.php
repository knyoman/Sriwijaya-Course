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
        Schema::table('pengguna', function (Blueprint $table) {
            $table->string('nomor_telepon')->nullable()->after('alamat');
            $table->date('tanggal_lahir')->nullable()->after('nomor_telepon');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->after('tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn(['nomor_telepon', 'tanggal_lahir', 'jenis_kelamin']);
        });
    }
};
