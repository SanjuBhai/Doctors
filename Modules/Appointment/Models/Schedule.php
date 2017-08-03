<?php

namespace Modules\Appointment\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table = 'schedules';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'user_id', 'date', 'time', 'is_used'
    ];

    // Listeners
    public static function boot()
    {
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });

        static::updating(function ($model) {
            // blah blah
        });

        static::deleting(function ($model) {
            // blah blah
        });
        
        parent::boot();
    }
}