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

    /**
     * Get random soal untuk quiz tanpa orderBy
     * @param int $limit Jumlah soal yang akan ditampilkan
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSoalRandom($limit = null)
    {
        // Query langsung tanpa relasi yang sudah punya orderBy
        $query = SoalQuiz::where('quiz_id', $this->id);

        // Jika limit null, ambil semua soal
        if ($limit === null) {
            $limit = $this->jumlah_soal;
        }

        // Pastikan limit tidak melebihi total soal yang ada
        $totalSoal = $query->count();
        $limit = min($limit, $totalSoal);

        // Ambil secara random tanpa orderBy yang mengacaukan
        return $query->inRandomOrder()->take($limit)->get();
    }
}
