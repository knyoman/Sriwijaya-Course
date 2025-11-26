<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'activity_type',
        'description',
        'action_model',
        'model_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: User yang melakukan aktivitas
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Static method untuk mencatat aktivitas
     */
    public static function record($activityType, $description, $actionModel = null, $modelId = null)
    {
        if (!auth()->check()) {
            return null;
        }

        return self::create([
            'user_id' => auth()->id(),
            'activity_type' => $activityType,
            'description' => $description,
            'action_model' => $actionModel,
            'model_id' => $modelId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
