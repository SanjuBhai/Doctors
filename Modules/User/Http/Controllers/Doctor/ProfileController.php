<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Doctor;
use Validator, Auth, Session, Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(Doctor::class);
    }

    // Show Profile
    public function index()
    {
        return view('user::doctor.profile')->with('user', Auth::user());
    }

    // Update profile
    public function store()
    {
        if( Request::isMethod('post') )
        {
            $args = Request::all();
            $usersObject = Auth::User();
            $usersObject->fill($args);
            $saved = $usersObject->push();
            Session::flash('success', 'Profile updated successfully.');
        }

        return redirect()->back();
    }
}