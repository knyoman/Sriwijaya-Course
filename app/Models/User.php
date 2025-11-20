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
        'nomor_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'keahlian',
        'sertifikasi',
        'biografi',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    /**
     * Mutator untuk auto-hash password
     */
    public function setKataSandiAttribute($value)
    {
        // Jika nilai sudah berupa hash Bcrypt (dimulai dengan $2), simpan apa adanya
        if (str_starts_with($value, '$2')) {
            $this->attributes['kata_sandi'] = $value;
        } else {
            // Jika plain text, hash dengan Bcrypt
            $this->attributes['kata_sandi'] = Hash::make($value);
        }
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

    /**
     * Relationship: Certificates yang dimiliki pelajar
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'pelajar_id');
    }

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    /**
     * Check if password is plain text (tidak ter-hash)
     */
    public function isPlainTextPassword()
    {
        return !str_starts_with($this->kata_sandi, '$2');
    }
}
