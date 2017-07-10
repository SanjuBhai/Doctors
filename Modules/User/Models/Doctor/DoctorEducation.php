<?php

namespace Modules\User\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model
{
	protected $table = 'doctor_educations';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'doctor_id', 'title', 'institute', 'from_year', 'to_year'
    ];
}