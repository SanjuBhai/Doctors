<?php

namespace Modules\Appointment\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table = 'schedules';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'user_id', 'date', 'time', 'is_used', 'created_at'
    ];
}