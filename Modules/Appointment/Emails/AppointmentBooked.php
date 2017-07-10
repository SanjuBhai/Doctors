<?php

namespace Modules\Appointment\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User as Customer;
use Modules\User\Models\Doctor\Doctor as Provider;
use Modules\Appointment\Models\Appointment;

class AppointmentBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    public $provider;
    
    public $appointment;

    private $user_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, Provider $provider, Appointment $appointment, $user_type)
    {
        $this->customer = $customer;
        $this->provider = $provider;
        $this->appointment = $appointment;
        
        $this->user_type = $user_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->user_type == 'customer' ? 'Appointment scheduled' : 'New Appointment Request';
        $template = $this->user_type == 'customer' ? 'booking-mail-to-customer' : 'booking-mail-to-provider';
        
        return $this->view('appointment::emails.'.$template)->subject( $subject );
    }
}
