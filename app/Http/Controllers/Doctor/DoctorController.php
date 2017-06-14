<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller as Controller;

use Request, Session, DB, Config;

use App\User, App\Doctor, App\Specialization;

class DoctorController extends Controller
{
    public function signup()
    {
        $doctor = new User;
        
        $prefix = array('Dr.', 'Dt.', 'Mr.', 'Ms.', 'Mrs.');
        
        // Get all specialities
        $specialities = Specialization::where('status', 1)->pluck('name', 'id')->all();
        
        return view('doctors.signup')->with([
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

        return view('doctors.details')
        	->with('doctor', $doctor);
    }
}