<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Specialization, App\Doctor;

class DoctorSearch extends Doctor
{
	protected $table = 'doctors_search';

	protected $primaryKey = 'doctor_id';

	public $timestamps = false;

    protected $fillable = [
        'doctor_id','speciality_id', 'gender', 'data', 'clinic_fees', 'clinic_latitude','clinic_longitude', 'status'
    ];

    // Get related specilization
    public function specialization()
    {
        return $this->hasOne('App\Specialization', 'id', 'speciality_id');
    }
}