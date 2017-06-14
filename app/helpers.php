<?php

function is_localhost()
{
    $whitelist = array('127.0.0.1', '::1');
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist) ? true : false;
}

// Convert number into K, M and B format
function format_number($num, $precision = 2)
{
    if ($num >= 1000 && $num < 1000000) {
        $n_format = number_format($num/1000,$precision).'K';
    } else if ($num >= 1000000 && $num < 1000000000) {
        $n_format = number_format($num/1000000,$precision).'M';
    } else if ($num >= 1000000000) {
        $n_format=number_format($num/1000000000,$precision).'B';
    } else {
        $n_format = $num;
    }
    
    return $n_format;
}

function is_email( $email )
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Trim all values in array
function trim_values( $array = array() )
{
    foreach($array as $key => $val){
        $array[$key] = is_array($val) ? $val : trim($val);
    }
    
    return $array;
}

// Trim all values in array
function trim_and_remove_tags( $array = array() )
{
    foreach($array as $key => $val){
        $array[$key] = is_array($val) ? $val : trim(strip_tags($val));
    }
    
    return $array;
}

// Convery string into url friendly string 
function makeSlug( $string )
{
    return strtolower(preg_replace('/\W+/', '-', $string));
}

// Generate random string
function generateRandomString($length = 10) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Generate unique file name for uploading
function generateUniqueFileName($extension)
{
    $folder = date('Y-m');
    $path = public_path('uploads/'.$folder);
    if( !is_dir( $path ) ){
        mkdir( $path );
    }
        
    $name = md5(str_random(10)).'.'.$extension;
    return file_exists($path.'/'.$name) ? generateUniqueFileName($extension) : $folder.'/'.$name;
}

function remove_querystring_var($url, $key) { 
    return preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $url);
}

// Get lat and long from address using Google api  
function getLatLong($address)
{
    $address = trim( $address );
    if(!empty($address))
    {
        $key = config('constants.google_api_key');
        $formattedAddr = str_replace(' ','+', $address);
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.$formattedAddr.'&sensor=false'); 
        $output = json_decode($geocodeFromAddr);
        if( !empty($output->results) )
        {
            $data['latitude']  = $output->results[0]->geometry->location->lat; 
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            return $data;
        }
    }

    return false;
}

// Get distance between two places in km using latlongs
function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 ) 
{
    $earth_radius = 6371;

    $dLat = deg2rad( $latitude2 - $latitude1 );  
    $dLon = deg2rad( $longitude2 - $longitude1 );  

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  

    return $d;
}

// Get image url
function getImageUrl( $object )
{
    if( $object->image && file_exists( public_path('uploads/'.$object->image) ) ){
        return url('uploads/'.$object->image);
    }

    if( $object->gender == 'female' ){
        return url('images/female.png');    
    }
    
    return url('images/male.png');
}
?>