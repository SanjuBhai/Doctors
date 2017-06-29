<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
	protected $table = 'otp';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'user_id', 'otp', 'mobile', 'is_used'
    ];
}