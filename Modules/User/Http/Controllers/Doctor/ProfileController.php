<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Doctor as DoctorMiddleware;
use Modules\User\Models\Doctor\Doctor;
use Validator, Auth, Session, Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(DoctorMiddleware::class);
    }

    // Show Profile
    public function index()
    {
        $doctor = Doctor::with('user')->where('doctor_id', Auth::user()->id)->first();
        return view('user::doctor.profile')->with('doctor', $doctor);
    }

    // Update profile
    public function store()
    {
        if( Request::isMethod('post') )
        {
            $args = Request::all();
            $doctor = Doctor::with('user')->where('doctor_id', Auth::user()->id)->first();
            $doctor->fill( $args );
            $saved = $doctor->push();
            Session::flash('success', 'Profile updated successfully.');
        }

        return redirect()->back();
    }
}