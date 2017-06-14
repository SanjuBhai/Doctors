<?php

namespace App\Http\Controllers;

use Request, Session, Config;
use App\Specialization, App\Data;

class ApiController extends Controller
{
    private $google_places_api_url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json';

    // Get cities
    public function getCities()
    {
        $key = config('constants.google_api_key');
        $components = 'country:in';
        $types = "(cities)";
        $input = urlencode( trim(Request::get('query')) );
        $url = $this->google_places_api_url.'?input='.$input.'&key='.$key.'&components='.$components.'&types='.$types;

        $matches = array();
        $data = json_decode(file_get_contents($url));
        if( $data->status == 'OK' )
        {
            foreach ($data->predictions as $key => $value) {
                $matches[] = $value->terms[0]->value;
            }
            $matches = array_unique($matches);
        }

        return json_encode($matches);
    }

    // Get localities
    public function getLocalities()
    {
        $key = config('constants.google_api_key');
        $components = 'country:in';
        $types = "(regions)";
        $radius = 500;
        $location = '';
        $input = urlencode( trim(Request::get('query')) );
        $url = $this->google_places_api_url.'?input='.$input.'&key='.$key.'&components='.$components.'&types='.$types;
        
        $matches = array();
        $data = json_decode(file_get_contents($url));
        if( $data->status == 'OK' )
        {
            foreach ($data->predictions as $key => $value) {
                $matches[] = $value->terms[0]->value;
            }
            $matches = array_unique($matches);
        }
        
        return json_encode($matches);
    }

    // Get data
    public function getData()
    {
        $matches = array();
        $data = Data::where('status', 1)->where('name' ,'like', '%'.trim(Request::get('query').'%'))->get();
        foreach ($data as $key => $value) {
            $matches[] = $value->name;
        }
        
        return json_encode($matches);
    }
}