<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller as Controller;

use Request, Session, DB, Config;

class DoctorController extends Controller
{
    public function signup()
    {
        return view('doctors.signup');
    }
}