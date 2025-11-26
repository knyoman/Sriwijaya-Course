<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'kursus_id',
        'judul_materi',
        'deskripsi',
        'urutan',
        'tipe_konten',
        'url_konten',
        'durasi_menit',
        // assignment-related
        'has_tugas',
        'tugas_instruksi',
        'tugas_soal',
    ];

    protected $casts = [
        'has_tugas' => 'boolean',
    ];

    /**
     * Relationship: Materi belongs to Kursus
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    /**
     * Submissions (tugas) untuk materi ini
     */
    public function submissions()
    {
        return $this->hasMany(\App\Models\MateriSubmission::class, 'materi_id');
    }
}
