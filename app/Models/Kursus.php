<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursus';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'image',
        'pengajar_id',
        'status',
        'konten',
        'durasi_jam',
        'jumlah_pelajar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Relationship: Kursus belongs to Pengajar (User)
     */
    public function pengajar()
    {
        return $this->belongsTo(User::class, 'pengajar_id');
    }

    /**
     * Relationship: Kursus has many Pelajar (Many-to-Many)
     */
    public function pelajar()
    {
        return $this->belongsToMany(
            User::class,
            'kursus_pelajar',
            'kursus_id',
            'pelajar_id'
        );
    }

    /**
     * Relationship: Kursus has many Materi
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'kursus_id')->orderBy('urutan');
    }

    /**
     * Relationship: Kursus has many Quiz
     */
    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'kursus_id')->orderBy('urutan');
    }

    /**
     * Mutator: Auto generate slug from nama
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    /**
     * Scope: Filter by status
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Filter by pengajar
     */
    public function scopeByPengajar($query, $pengajarId)
    {
        return $query->where('pengajar_id', $pengajarId);
    }
}
