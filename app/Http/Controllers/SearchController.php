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

            $matches = array();
            $per_page = 20;
            $page = isset($arguments['page']) ? $arguments['page'] : 1;
            $offset = ($page-1) * $per_page;

            // Get Doctors
            $select = '*';
            $doctors = Doctor::where('status', 1)
                ->with('specialization')
                ->orderBy('created_at', 'desc')
                ->take($per_page)
                ->skip($offset);
            
            // Get gender
            preg_match('/gender=(.*)\&fees/', $arguments['filters'], $matches);
            $gender = isset($matches[1]) ? $matches[1] : '';
            if( $gender ) 
            {
                $gender = str_replace(array('m', 'f'), array('male', 'female') , $gender);
                $doctors = $doctors->whereIn('gender', explode(',', $gender));
            }

            // Get fees
            preg_match('/fees=(.*)\&order/', $arguments['filters'], $matches);
            $fees = isset($matches[1]) ? $matches[1] : '';
            if( $fees ) 
            {
                list($min, $max) = explode(',', $fees);
                $doctors = $doctors->where('clinic_fees', '>=', $min);
                $doctors = $doctors->where('clinic_fees', '<=', $max);
            }

            // Get city
            preg_match('/city=(.*)\&speciality/', $arguments['filters'], $matches);
            $city = isset($matches[1]) ? $matches[1] : '';
            
            // Get locality
            preg_match('/locality=(.*)\&gender/', $arguments['filters'], $matches);
            $locality = isset($matches[1]) ? $matches[1] : '';
            
            // Get lat long of selected location 
            $latlong = getLatLong($city.' '.$locality);
            if( $latlong ) 
            {
                $select = DB::raw('*, SQRT(POW(69.1 * (clinic_latitude - '.$latlong['latitude'].'), 2) + POW(69.1 * ('.$latlong['longitude'].' - clinic_longitude) * COS(clinic_latitude / 57.3), 2)) AS distance');
                $doctors = $doctors->havingRaw('distance < 10');
            }

            // Get specialities
            preg_match('/speciality=(.*)\&locality/', $arguments['filters'], $matches);
            $specialities = isset($matches[1]) ? $matches[1] : '';
            if( $specialities ) {
                $doctors = $doctors->whereIn('speciality_id', explode(',', $specialities));
            }

            $doctors = $doctors->select($select);
            // print_r($doctors->get()->toArray());exit;
            // echo $doctors->toSql(); exit;

            return view('search-results')
                ->with('doctors', $doctors->get());
        }

        // Get specializations
        $specializations = Specialization::where('type', 1)->get();
        
        return view('search')
            ->with('specializations', $specializations);
    }
}