<?php

namespace Modules\User\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
	protected $table = 'specializations';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'name', 'status'
    ];
}