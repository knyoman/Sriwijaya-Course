<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

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

    // Hash password sebelum disimpan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->kata_sandi) {
                $model->kata_sandi = Hash::make($model->kata_sandi);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('kata_sandi')) {
                $model->kata_sandi = Hash::make($model->kata_sandi);
            }
        });
    }

    /**
     * Relationship: Kursus yang dibuat oleh pengajar
     */
    public function kursusDibuatnya()
    {
        return $this->hasMany(Kursus::class, 'pengajar_id');
    }

    /**
     * Relationship: Kursus yang diikuti pelajar (Many-to-Many)
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(
            Kursus::class,
            'kursus_pelajar',
            'pelajar_id',
            'kursus_id'
        )->withPivot('status', 'nilai_akhir')->withTimestamps();
    }

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
