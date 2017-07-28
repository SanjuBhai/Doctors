<?php

namespace Modules\User\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Middleware\Doctor;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware(Doctor::class);
    }
    
    public function index()
    {
        return view('user::doctor.dashboard');
    }
}