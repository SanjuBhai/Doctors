<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
	protected $table = 'symptoms';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'name', 'status'
    ];
}