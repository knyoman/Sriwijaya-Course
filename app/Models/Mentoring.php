<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $table = 'mentoring';

    protected $fillable = [
        'pengajar_id',
        'kursus_id',
        'tanggal',
        'jam',
        'durasi',
        'topik',
        'status',
        'zoom_link',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relationship: Mentoring belongs to Pengajar (User)
     */
    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    /**
     * Relationship: Mentoring belongs to Kursus
     */
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    /**
     * Relationship: Mentoring has many Feedback
     */
    public function feedbacks()
    {
        return $this->hasMany(MentoringFeedback::class, 'mentoring_id');
    }
}
