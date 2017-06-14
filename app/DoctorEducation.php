<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model
{
	protected $table = 'doctor_educations';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'doctor_id', 'title', 'institute', 'from_year', 'to_year', 'created_at'
    ];
}