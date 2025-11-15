<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalQuiz extends Model
{
    use HasFactory;

    protected $table = 'soal_quiz';

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
        'urutan',
    ];

    /**
     * Relationship: SoalQuiz belongs to Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
