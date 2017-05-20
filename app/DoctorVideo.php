<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorVideo extends Model
{
	use SoftDeletes;

	protected $table = 'doctor_videos';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'doctor_id', 'title', 'video_url', 'status', 'created_at'
    ];
}