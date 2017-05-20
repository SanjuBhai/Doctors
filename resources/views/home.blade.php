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
               <input type="text" class="form-control mb-2 f-location" name='city' id="city" placeholder="Enter location*">
            </div>
            <div class="input-group col-sm-3 no-padding">
               <input type="text" class=" form-control mb-2 f-location" name='locality' id="locality" placeholder="Enter locality">
            </div>
            <div class="input-group col-sm- 3 no-padding">
               <select name="speciality" id='speciality' class="form-control">
                  <option value=''>--- Select---</option>
                  @foreach($specializations as $key => $val)
                     <option value="{{ $val->id }}">{{ $val->name }}</option>  
                  @endforeach
               </select>
            </div>
            <input type="hidden" name='lat' id='latitude'>
            <input type="hidden" name='long' id='longitude'>
            <input type="button" value="Locate me" id='locate_me' class='btn btn-default pointer'>
            <button type="submit" class="btn btn-primary search-btn pointer">Search</button>
         </form>
      </div>
   </div>
</div>
<!--end of banner-wrap div -->
<div class="health-issues">
   <div class="container">
      <div class="tab-wrap">
         <!-- Nav tabs -->
         <ul class="nav nav-tabs tabs-list" role="tablist">
            <li role="presentation" class="active"><a href="#skin" aria-controls="skin" role="tab" data-toggle="tab">Skin &amp; Hair care</a></li>
            <li role="presentation"><a href="#dentail" aria-controls="dentail" role="tab" data-toggle="tab">Healthy Teeth</a></li>
            <li role="presentation"><a href="#asthma" aria-controls="asthma" role="tab" data-toggle="tab">Chronic Conditions</a></li>
            <li role="presentation"><a href="#eye" aria-controls="eye" role="tab" data-toggle="tab">General Health</a></li>
            <li role="presentation"><a href="#eye" aria-controls="eye" role="tab" data-toggle="tab">General Health</a></li>
            <li role="presentation"><a href="#eye" aria-controls="eye" role="tab" data-toggle="tab">General Health</a></li>
            <li role="presentation"><a href="#eye" aria-controls="eye" role="tab" data-toggle="tab">General Health</a></li>
         </ul>
         <!-- Tab panes -->
      </div>
   </div>
</div>
<!--end of health-issues div -->
<div class="container tab-content content-tabwrap">
   <div role="tabpanel" class="tab-pane active " id="skin">
      <div class="row">
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Hair Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="doctor-list.html" class="box-wrap">
               <div class="box-1"></div>
               <span>Hair Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="doctor-list.html" class="box-wrap">
               <div class="box-1"></div>
               <span>Hair Care</span>
            </a>
         </div>
      </div>
   </div>
   <div role="tabpanel" class="tab-pane" id="dentail">
      <div class="row">
         <div class="col-md-2">
            <a href="doctor-list.html" class="box-wrap">
               <div class="box-1"></div>
               <span>Dentail Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="doctor-list.html" class="box-wrap">
               <div class="box-1"></div>
               <span>Dentail Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="doctor-list.html" class="box-wrap">
               <div class="box-1"></div>
               <span>Dentail Care</span>
            </a>
         </div>
      </div>
   </div>
   <div role="tabpanel" class="tab-pane" id="asthma">
      <div class="row">
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Hypertension</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Thyroid</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Hypertension</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Hypertension</span>
            </a>
         </div>
      </div>
   </div>
   <div role="tabpanel" class="tab-pane" id="eye">
      <div class="row">
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Hair Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Eye Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Eye Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Eye Care</span>
            </a>
         </div>
         <div class="col-md-2">
            <a href="#" class="box-wrap">
               <div class="box-1"></div>
               <span>Eye Care</span>
            </a>
         </div>
      </div>
   </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAB3fKkM-Kuw9Xx-qpCcYIfJh71qTGNsGk"></script>
<script type="text/javascript">
   $('#locate_me').click(function(){
      if(navigator.geolocation) 
      {
         navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=false';
            $('#searchForm .form-control').attr('disabled', true);
            $.getJSON(url, {}, function(rs){
              console.log(rs);
              $('#latitude').val(position.coords.latitude);
              $('#longitude').val(position.coords.longitude);
              $('#searchForm .form-control').attr('disabled', false);
            });
         }, function() {
            console.log('The Geolocation service failed.');
          });
     } else {
       alert('Your browser doesn\'t support geolocation.');
     }
   });

   $('#searchForm').submit(function(e){
      e.preventDefault();
      var hash = '#city='+$('#city').val().trim()+'&speciality='+$('#speciality').val().trim()+'&locality='+$('#locality').val()+'&gender=';
      window.location.href = '/search' + hash;
   });
</script>
@endsection