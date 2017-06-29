@extends('layouts.app')

@section('title', 'Doctors')

@section('content')

<div class="banner-wrap">
   <div class="container text-center">
      <h1>Your home for health </h1>
      <span>Find and Book</span>
      <div class="row form-wrap">
         <form class="form-inline" action="{{ url('search') }}" method="get" id='searchForm'>
            <div class="input-group col-sm-3 no-padding">
               <input type="text" class="form-control mb-2 f-location" name='city' id="city" placeholder="Enter city*" required autocomplete="off">
            </div>
            <div class="input-group col-sm-3 no-padding">
               <input type="text" class=" form-control mb-2 f-location" name='locality' id="locality" placeholder="Enter locality" autocomplete="off">
            </div>
            <div class="input-group col-sm- 3 no-padding">
               <input type="text" class=" form-control mb-2 f-location" name='speciality' id="speciality" placeholder="Enter speciality/symptom" autocomplete="off">
            </div>
            <input type="hidden" name='lat' id='latitude'>
            <input type="hidden" name='long' id='longitude'>
            <input type="button" value="Locate me" id='locate_me' class='btn btn-default pointer'>
            <button type="submit" class="btn btn-primary search-btn pointer">Search</button>
         </form>
      </div>
   </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{ config('constants.google_api_key') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
jQuery(function($){
   var _token = "<?php echo csrf_token(); ?>";

   var cityUrl = '/api/get-cities';
   $('#city').typeahead({
      source:  function (query, process) {
         return $.post(cityUrl, {query: query, _token: _token}, function(response){
            return process($.parseJSON(response));
         });
      }
   });

   var localityUrl = '/api/get-localities';
   $('#locality').typeahead({
      source:  function (query, process) {
         return $.post(localityUrl, {query: $('#city').val()+' '+query, _token: _token}, function(response){
            return process($.parseJSON(response));
         });
      }
   });

   var specialityUrl = '/api/get-data';
   $('#speciality').typeahead({
      source:  function (query, process) {
         return $.post(specialityUrl, {query: query, _token: _token}, function(response){
            return process($.parseJSON(response));
         });
      }
   });
});

getCurrentLocation();
$('#locate_me').click(getCurrentLocation);

$('#searchForm').submit(function(e){
   e.preventDefault();
   var hash = '#find='+encodeURIComponent($('#speciality').val().trim())+'&city='+encodeURIComponent($('#city').val().trim())+'&speciality=&locality='+encodeURIComponent($('#locality').val().trim())+'&gender=&fees=&order=&page=1';
   window.location.href = '/search' + hash;
});

function getCurrentLocation()
{
   if(navigator.geolocation)
   {
      navigator.geolocation.getCurrentPosition(function(position) {
         var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
         var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=false';
         $.getJSON(url, {}, function(response){
            if( response.status == 'OK' )
            {
               var results = response.results;
               $('#latitude').val(position.coords.latitude);
               $('#longitude').val(position.coords.longitude);
               
               var city = '';
               var locality = '';
               if( typeof results[1] != undefined )
               {
                  for (var i = 0; i < results[0].address_components.length; i++) 
                  {
                     for (var b = 0; b < results[0].address_components[i].types.length; b++) 
                     {
                        if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                           city = results[0].address_components[i].long_name;
                           break;
                        }

                        if (results[0].address_components[i].types[b] == "sublocality_level_2") {
                           locality = results[0].address_components[i].long_name;
                        }

                        if (locality=='' && results[0].address_components[i].types[b] == "sublocality_level_1") {
                           locality = results[0].address_components[i].long_name;
                        }
                     }
                  }
               }
            }
            $('#city').val(city);
            $('#locality').val(locality);
         });
      }, function() {
         console.log('The Geolocation service failed.');
      });
   } else {
      console.log('Your browser doesn\'t support geolocation.');
   }
}

function codeAddress( address )
{
   var geocoder = new google.maps.Geocoder();
   geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
         latitude = results[0].geometry.location.lat();
         longitude = results[0].geometry.location.lng();
         console.log( latitude + ' , ' +  longitude);
      } else {
         return false;
      }
   });
}
</script>
@endsection