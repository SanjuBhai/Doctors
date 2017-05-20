<?php

namespace App\Http\Controllers;

use Request, Session, DB;
use App\Specialization, App\Doctor;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    // Search
    public function search()
    {
        if( Request::isMethod('post') )
        {
            $arguments = Request::all();

            // print_r($arguments);exit;
            $matches = array();
            $city = preg_match('/city=(.*)\&speciality/', $arguments['filters'], $matches);
            $city = $matches[1];
            
            $speciality = preg_match('/speciality=(.*)\&locality/', $arguments['filters'], $matches);
            $speciality = $matches[1];
            $speciality = $speciality ? explode(',', $speciality) : array();
            
            $locality = preg_match('/locality=(.*)\&gender/', $arguments['filters'], $matches);
            $locality = $matches[1];
            $locality = $locality ? explode(',', $locality) : array();
            
            $per_page = 20;
            $page = isset($arguments['page']) ? $arguments['page'] : 1;
            $offset = ($page-1) * $per_page;

            // Get Doctors
            $doctors = Doctor::where('status', 1)
                ->with('specialization')
                ->orderBy('created_at', 'desc')
                ->take($per_page)
                ->skip($offset);
                
            if( $speciality ) {
                $doctors = $doctors->whereIn('speciality_id', $speciality);
            }

            if( $city ) {
                $doctors = $doctors->where('clinic_city', 'like', $city);
            }

            if( $locality ) 
            {
                foreach ($locality as $key => $value) {
                    $doctors = $doctors->where('clinic_locality', 'like', $val);   
                }
            }

            // print_r($doctors->get()->toArray());exit;

            return view('search-results')
                ->with('doctors', $doctors->get());
        }

        // Get specializations
        $specializations = Specialization::get();
        
        return view('search')
            ->with('specializations', $specializations);
    }
}