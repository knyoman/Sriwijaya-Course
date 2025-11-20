<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentoringFeedback extends Model
{
    use HasFactory;

    protected $table = 'mentoring_feedback';

    protected $fillable = [
        'mentoring_id',
        'pelajar_id',
        'rating',
        'feedback_text',
        'benefits',
    ];

    protected $casts = [
        'benefits' => 'array',
    ];

    /**
     * Relationship: Feedback belongs to Mentoring
     */
    public function mentoring()
    {
        return $this->belongsTo(Mentoring::class, 'mentoring_id');
    }

    /**
     * Relationship: Feedback belongs to Pelajar (User)
     */
    public function pelajar()
    {
        return $this->belongsTo(User::class, 'pelajar_id');
    }
}
