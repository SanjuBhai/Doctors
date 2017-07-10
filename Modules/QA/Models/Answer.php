<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	use SoftDeletes;

	protected $table = 'answers';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'question_id', 'question_owner_id','doctor_id','answer','likes','dislikes'
    ];
}