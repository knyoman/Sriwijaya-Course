<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriSubmission extends Model
{
    use HasFactory;

    protected $table = 'materi_submissions';

    protected $fillable = [
        'materi_id',
        'pelajar_id',
        'file_path',
        'komentar',
        'status',
        'nilai',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function pelajar()
    {
        return $this->belongsTo(User::class, 'pelajar_id');
    }
}
