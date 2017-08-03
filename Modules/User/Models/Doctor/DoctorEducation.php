<?php

namespace Modules\User\Models\Doctor;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\Doctor\Doctor;

class DoctorEducation extends Model
{
	protected $table = 'doctor_educations';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'doctor_id', 'title', 'institute', 'from_year', 'to_year'
    ];

    // Listeners
	public static function boot()
	{
		static::created(function ($model) {
			$doctor = Doctor::with('specialization')->where('doctor_id', $model->doctor_id)->first();
			$doctor->updateSearchData();
		});
		
		static::updated(function ($model) {
			$doctor = Doctor::with('specialization')->where('doctor_id', $model->doctor_id)->first();
			$doctor->updateSearchData();
		});

		static::deleted(function ($model) {
			$doctor = Doctor::with('specialization')->where('doctor_id', $model->doctor_id)->first();
			$doctor->updateSearchData();
		});
		
		parent::boot();
	}
}