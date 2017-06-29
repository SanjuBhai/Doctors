<?php

namespace Modules\Appointment\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleArchive extends Model
{
	protected $table = 'schedules_archive';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'user_id', 'date', 'time', 'is_used', 'created_at'
    ];
}