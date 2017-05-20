<?php

namespace App\Http\Controllers;

use Request, Session;
use App\Specialization;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
    	$specializations = Specialization::get();
        return view('home')->with('specializations', $specializations);
    }
}