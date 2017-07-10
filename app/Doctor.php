<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Specialization, App\DoctorEducation, App\DoctorVideo;

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

    // Get related specilization
    public function specialization()
    {
        return $this->hasOne('App\Specialization', 'id', 'speciality_id');
    }

    // Get educations
    public function educations()
    {
        return $this->hasMany('App\DoctorEducation', 'doctor_id', 'doctor_id');
    }

    // Get videos
    public function videos()
    {
        return $this->hasMany('App\DoctorVideo', 'doctor_id', 'doctor_id');
    }
}