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
    ];

    /**
     * Relationship: Materi belongs to Kursus
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
}
