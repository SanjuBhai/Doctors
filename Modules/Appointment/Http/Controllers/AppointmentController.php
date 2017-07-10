<?php

namespace Modules\Appointment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Appointment\Emails\AppointmentBooked;
use Modules\Appointment\Models\Schedule, Modules\Appointment\Models\Appointment;
use App\OTP;
use App\User as Customer;
use Modules\User\Models\Doctor\Doctor as Provider;
use Auth, Mail, Session, Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('appointment::index');
    }

    protected function getError( $validator )
    {
        $messages = [];
        if( $validator->errors() ){
            foreach($validator->errors()->getMessages() as $key => $val) {
                $messages[] = implode(' ', $val);
            }
            $message = implode(' and ', $messages);         
            return $message ? $message.'.' : null;
        }
        return null;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create( $slug )
    {
        // Get provider details 
        $provider = Provider::with('user')->where('slug', $slug)
            ->where('status', 1)
            ->first();
        
        if( ! $provider ) {
            abort('404');
        }

        $begin = new \DateTime();
        $end = new \DateTime();
        $period = new \DatePeriod( $begin, new \DateInterval('P1D'), $end->modify('+30 days') );

        $dates = array();
        foreach($period as $date) 
        {
            $day = $date->format("Y-m-d");
            $dates[$day]['day'] = $date->format('D');
            $dates[$day]['date'] = $date->format('d');
            $dates[$day]['month'] = $date->format('M');
        }

        // Get all schedules
        $schedules = Schedule::select('id', 'date', 'time')
            ->where('user_id', $provider->doctor_id)
            ->where('is_used', 0)
            ->where('date', '>=', $begin->format('Y-m-d'))
            ->where('date', '<', $end->format('Y-m-d'))
            ->get()
            ->toArray();

        if( $schedules )
        {
            foreach ($schedules as $key => $value) {
                $dates[ $value['date'] ]['schedules'][$value['id']] = substr($value['time'], 0, -3);
            }
        }
        
        // print_r($dates);exit;
        
        return view('appointment::create')->with([
            'provider' => $provider,
            'user'   => Auth::user(),
            'dates'  => $dates
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if( $request->isMethod('post') )
        {
            $params = $request->all();
            
            try
            {
                // Check if Provider exists
                $provider = Provider::with('user')
                    ->where('slug', $params['slug'])
                    ->first();

                if( !$provider ) {
                    throw new \Exception('No Provider selected.', 1);
                }

                // Validate OTP
                if( isset($params['otp']) ) {

                }

                $params['fees'] = $provider->clinic_fees;

                $validator = Validator::make($params, [
                    'name' => 'required|max:255|alpha_spaces',
                    'email' => 'email',
                    'phone' => 'required',
                    'book_datetime' => 'required'
                ]);

                if( $validator->fails() ) {
                    throw new \Exception($this->getError( $validator ), 1);
                }

                // Save appointment
                $appointment = new Appointment;
                $appointment->fill( $params );
                $appointment->provider_id = $provider->doctor_id;
                $appointment->customer_id = Auth::check() ? Auth::user()->id : 0;
                if( $appointment->save() )
                {
                    // Update schedule
                    Schedule::where('id', $params['schedule_id'])->update([
                        'is_used' => 1
                    ]);
                    
                    // Send Notifications by email
                    $customer = Auth::check() ? Auth::user() : new Customer;
                    $this->sendMailToCustomer($params['email'], $customer, $provider, $appointment);
                    $this->sendMailToProvider($provider->user->email, $customer, $provider, $appointment);
                }

            } catch (\Exception $e) {

                $response = array(
                    'status' => 'error',
                    'message' => $e->getMessage()
                );

                return json_encode($response);
            }

            return json_encode( array('status' => 'success') );
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('appointment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('appointment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    // Send email notification to customer
    public function sendMailToCustomer($email, $customer, $provider, $appointment)
    {
        Mail::to( $email )->send(new AppointmentBooked(
            $customer, $provider, $appointment, 'customer'
        ));
    }

    // Send email notification to Service provider eg: Doctor, Barber, Tutor
    public function sendMailToProvider($email, $customer, $provider, $appointment)
    {
        Mail::to( $email )->send(new AppointmentBooked(
            $customer, $provider, $appointment, 'provider'
        ));
    }
}