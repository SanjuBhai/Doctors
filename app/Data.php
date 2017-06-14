<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
	protected $table = 'data';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'name', 'type', 'status'
    ];
}