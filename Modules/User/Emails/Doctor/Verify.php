<?php

namespace Modules\User\Emails\Doctor;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Modules\User\Models\Doctor\Doctor;

class Verify extends Mailable
{
    use Queueable, SerializesModels;

    public $doctor;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.doctor.verify')->subject('Acocunt verified');
    }
}
