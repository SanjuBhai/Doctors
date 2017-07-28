<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Doctor;
use Hash, Validator, Auth, Session, Request;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(Doctor::class);
    }

    // Show form
    public function index()
    {
        return view('user::doctor.change-password');
    }
    
    // Change password
    public function store()
    {
        if( Request::isMethod('post') )
        {
            $post = Request::all();
            $errors = array();
            if(!Hash::check($post['current_password'], Auth::user()->password)){
                $errors[] = "Invalid current password.";    
            }
            
            if($post['password'] != $post['password_confirmation']){
                $errors[] = "Passwords does not match.";
            }
            
            if( $errors ) {
                Session::flash('error', implode(' ', $errors));
            } else {
                $user = Auth::user();
                $user->password = bcrypt($post['password']);
                $user->save();
                Session::flash('success', 'Password updated successfully.');
            }
        }

        return redirect()->back();
    }
}