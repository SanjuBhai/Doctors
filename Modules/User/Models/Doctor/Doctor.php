<?php

namespace Modules\User\Models\Doctor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\Doctor\Specialization;
use Modules\User\Models\Doctor\DoctorEducation;
use Modules\User\Models\Doctor\DoctorVideo;

class Doctor extends Model
{
	use SoftDeletes;

	protected $table = 'doctors';

	protected $primaryKey = 'doctor_id';

	public $timestamps = true;

    protected $fillable = [
        'doctor_id','speciality_id', 'name', 'image', 'gender', 'qualifications', 'medical_registration_number','referral_code','prefix','clinic_name','clinic_fees','clinic_phone','clinic_city','clinic_locality','online_fees','experience','personal_statement','clinic_latitude','clinic_longitude','rating_count','like_count','status','facebook_link','twitter_link','linkedin_link','googleplus_link'
    ];
    
    // Get full name
    public function getFullName()
    {
        return $this->prefix.' '.$this->name;
    }

    // Get image url
    public function getImageUrl()
    {
        if( $this->image && file_exists( public_path('uploads/'.$this->image) ) ){
            return url('uploads/'.$this->image);
        }

        if( $this->gender == 'female' ){
            return url('images/female.png');    
        }

        return url('images/male.png');
    }

    // Get user details
    public function user()
    {
        return $this->belongsTo('App\User', 'doctor_id', 'id');
    }

    // Get related specilization
    public function specialization()
    {
        return $this->hasOne('Modules\User\Models\Doctor\Specialization', 'id', 'speciality_id');
    }

    // Get educations
    public function educations()
    {
        return $this->hasMany('Modules\User\Models\Doctor\DoctorEducation', 'doctor_id', 'doctor_id');
    }

    // Get videos
    public function videos()
    {
        return $this->hasMany('Modules\User\Models\Doctor\DoctorVideo', 'doctor_id', 'doctor_id');
    }
}