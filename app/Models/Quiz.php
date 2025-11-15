<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = [
        'kursus_id',
        'nama_quiz',
        'deskripsi',
        'jumlah_soal',
        'durasi_menit',
        'urutan',
    ];

    /**
     * Relationship: Quiz belongs to Kursus
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    /**
     * Relationship: Quiz has many SoalQuiz
     */
    public function soal()
    {
        return $this->hasMany(SoalQuiz::class, 'quiz_id')->orderBy('urutan');
    }
}
