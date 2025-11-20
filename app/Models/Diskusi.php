<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Diskusi extends Model
{
    protected $table = 'diskusi';

    protected $fillable = [
        'kursus_id',
        'judul',
        'konten',
        'pembuat_id',
        'jumlah_balasan',
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }

    public function balasan()
    {
        return $this->hasMany(BalasDiskusi::class, 'diskusi_id')->orderBy('created_at');
    }
}
