<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'pelajar_id',
        'quiz_id',
        'kursus_id',
        'nama_kursus',
        'nilai',
        'nomor_sertifikat',
        'tanggal_cetak',
    ];

    protected $casts = [
        'tanggal_cetak' => 'datetime',
    ];

    /**
     * Relationship: Certificate belongs to User (Pelajar)
     */
    public function pelajar()
    {
        return $this->belongsTo(User::class, 'pelajar_id');
    }

    /**
     * Relationship: Certificate belongs to Quiz
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * Relationship: Certificate belongs to Kursus
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
}
