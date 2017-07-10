<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Request, Session;

use App\User;
use Modules\User\Models\Doctor\Doctor;
use Modules\User\Models\Doctor\Specialization;

class DoctorController extends Controller
{
    public function signup()
    {
        $doctor = new User;
        
        $prefix = array('Dr.', 'Dt.', 'Mr.', 'Ms.', 'Mrs.');
        
        // Get all specialities
        $specialities = Specialization::where('status', 1)->pluck('name', 'id')->all();
        
        return view('user::doctor.signup')->with([
            'prefix'        => $prefix,
            'specialities'  => $specialities,
            'doctor'        => $doctor 
        ]);
    }

    // Doctor full details
    public function details( $slug )
    {
    	$doctor = Doctor::where('slug', $slug)
    		->with(['specialization', 'educations', 'videos'])
    		->where('status', 1)
    		->first();
    		
        if( ! $doctor ) {
        	abort('404');
        }

        return view('user::doctor.details')
        	->with('doctor', $doctor);
    }
}