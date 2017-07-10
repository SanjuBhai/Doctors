<?php

namespace Modules\QA\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	use SoftDeletes;

	protected $table = 'questions';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'patient_id', 'speciality_id','question','status','views'
    ];
}