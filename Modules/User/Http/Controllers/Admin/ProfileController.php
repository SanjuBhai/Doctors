<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Admin;
use Validator, Auth, Session, Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(Admin::class);
    }

    // Show Profile
    public function index()
    {
        return view('user::admin.profile')->with('user', Auth::user());
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