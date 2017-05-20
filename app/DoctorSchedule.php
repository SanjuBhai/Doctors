<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
	use SoftDeletes;

	protected $table = 'doctor_schedules';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'doctor_id', 'date', 'time', 'created_at'
    ];
}