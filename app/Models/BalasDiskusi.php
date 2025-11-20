<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BalasDiskusi extends Model
{
    protected $table = 'balasan_diskusi';

    protected $fillable = [
        'diskusi_id',
        'pembuat_id',
        'konten',
    ];

    public function diskusi()
    {
        return $this->belongsTo(Diskusi::class, 'diskusi_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }
}
