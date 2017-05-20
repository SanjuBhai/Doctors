<?php

namespace app;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    protected $table = 'user_login_history';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['user_id', 'login_time', 'logout_time', 'user_agent', 'ip_address', 'mac_address'];
    
    protected $hidden = [];
}