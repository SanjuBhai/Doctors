<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';

	protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'name', 'value', 'autoload'
    ];
}