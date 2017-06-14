<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    protected $table = 'seo';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'title', 'description', 'keywords', 'banner', 'status'
    ];
}