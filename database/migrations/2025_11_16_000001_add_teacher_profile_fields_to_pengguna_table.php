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
            $table->string('keahlian')->nullable()->after('jenis_kelamin');
            $table->string('sertifikasi')->nullable()->after('keahlian');
            $table->text('biografi')->nullable()->after('sertifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn(['keahlian', 'sertifikasi', 'biografi']);
        });
    }
};
