<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'pengguna'; // Tambahkan baris ini!

    protected $fillable = [
        'username',
        'nama',
        'email',
        'kata_sandi',
        'peran',
        'alamat',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
