<?php

namespace Modules\User\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class DoctorSearch extends Model
{
	protected $table = 'doctors_search';

	protected $primaryKey = 'doctor_id';

	public $timestamps = false;

	protected $fillable = [
		'doctor_id','speciality_id', 'gender', 'clinic_fees', 'data', 'clinic_latitude', 'clinic_longitude'
	];
}