<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Mail, Session, Config;
use App\UserLoginHistory;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $primaryKey = 'id';
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'first_name','last_name','email','password','phone','role_id','image','state','city','address','facebook_id','twitter_id','google_id','linkedin_id','device_type','is_email_verified','remember_token','ip_address','user_agent'
    ];

    // Listeners
    public static function boot()
    {
        static::creating(function ($model) {
            $model->ip_address = ip2long($_SERVER['REMOTE_ADDR']);
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $model->is_email_verified = 0;
        });

        static::updating(function ($model) {
            // blah blah
        });

        static::deleting(function ($model) {
            // blah blah
        });
        
        parent::boot();
    }

    // Get profile image url
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
    
    // Get full user name
    public function getFullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    // Add record for last login
    public function updateLoginTime()
    {
        $loginRecord = new UserLoginHistory;
        $loginRecord->user_id = $this->id;
        $loginRecord->ip_address = $_SERVER['REMOTE_ADDR'];
        $loginRecord->login_time = date('Y-m-d H:i:s');
        $loginRecord->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $loginRecord->save();
    }
    
    // Update logout time for current user
    public function updateLogoutTime()
    {
        $loginRecord = UserLoginHistory::where(['user_id' => $this->id])->orderBy('id', 'desc')->first();
        $loginRecord->logout_time = date('Y-m-d H:i:s');
        $loginRecord->save();
    }
    
    // Get last login datetime
    public function getLastLoginTime()
    {
        $loginRecord = self::getLastLoginDetails();
        return isset($loginRecord[1]->login_time) ? $loginRecord[1]->login_time : $loginRecord[0]->login_time;
    }
    
    // Get last login details
    public function getLastLoginDetails()
    {
        $loginRecord = UserLoginHistory::where(['user_id' => $this->id])->orderBy('id', 'desc')->take(2)->get();
        return $loginRecord;
    }

    // Accessors
    public function getIpAddressAttribute($value)
    {
        return long2ip($value);
    }

    // Mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst( trim( strip_tags( $value ) ) );
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst( trim( strip_tags( $value ) ) );
    }
}