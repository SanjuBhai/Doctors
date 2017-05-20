<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	use SoftDeletes;

	protected $table = 'reviews';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'patient_id', 'doctor_id','rating','review','status'
    ];
}