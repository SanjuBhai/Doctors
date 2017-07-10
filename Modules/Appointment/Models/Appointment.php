<?php

namespace Modules\Appointment\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	protected $table = 'appointments';

	protected $primaryKey = 'id';

	public $timestamps = true;

    protected $fillable = [
        'provider_id', 'customer_id', 'book_datetime', 'name', 'email', 'phone', 'fees', 'notes', 'otp', 'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'book_datetime'
    ];
}