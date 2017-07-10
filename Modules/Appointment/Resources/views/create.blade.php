@extends('layouts.app')

@section('title', 'Book Appointment')

@section('content')

<div class="container pdTop-10 ">
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="row doctor-detailBox">
            <div class="col-sm-2">
               <span><img src="{{ $provider->getImageUrl() }}" alt="{{ $provider->prefix.' '.$provider->name }}" title="{{ $provider->prefix.' '.$provider->name }}" width='140' height='140'></span>
            </div>
            <div class="col-sm-6 doctor-profile">
               <span class="doctor-name"> 
                  {{ $provider->getFullName() }}
                  <span class="rating-icon">
                     <i class="fa fa-heart green-h" aria-hidden="true">&nbsp;94% 
                     ({{ $provider->rating_count }} ratings)</i>
                  </span>
               </span>
               <p><strong> {{ $provider->qualifications }} </strong></p>
               <span> {{ $provider->specialization->name }}, {{ $provider->clinic_city }}</span>
               <div class="fee-details">
                  <span>{{ $provider->experience }} Years Experience</span>
                  <span>₹{{ $provider->clinic_fees }} at clinic</span>
                  <span>₹{{ $provider->online_fees }} online</span>
               </div>
            </div>
            <div class="col-sm-4 report-issue">
               <a href="#" class="feedback-btn" id="consult-now" data-toggle="modal" data-target="#exampleModal" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Submit Feedback</a>
               <a href="#" class="issue-btn" id="call-now" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-flag" aria-hidden="true"></i> Report Issue</a>
            </div>
         </div>
      </div>
      <div class=" col-md-12 stepwizard">
         <ul class="stepwizard-row">
            <li class="stepwizard-step">
               <a class="btn btn-primary btn-circle steps active" id='step-1' href="#">1</a>
               <p>Appointment Info</p>
            </li>
            <li class="stepwizard-step">
               <a class="btn btn-primary btn-circle steps" id='step-2' href="#">2</a>
               <p>Patient Info</p>
            </li>
            <li class="stepwizard-step">
               <a class="btn btn-primary btn-circle steps" id='step-3' href="#">3</a>
               <p>Verify Mobile Number</p>
            </li>
            <li class="stepwizard-step">
               <a class="btn btn-primary btn-circle steps" id='step-4' href="#">4</a>
               <p>Finished!</p>
            </li>
         </ul>
         <div class="row rate-updates">
            <div class="col-md-12 tab-content">
               <div class="text-center tab-pane step-data active" id="step-1-data">
                   <div class="row">
                     <div class="col-md-8 offset-md-2">
                        <div class="flexslider" id='days-slider'>
                           <ul class="list-inline slides">
                              @foreach($dates as $key => $val)
                                 <li class="{{ $loop->iteration==1 ? 'active' : ''}}" data-timings="{{ $val['month'].'-'.$val['date'] }}">{{ $val['day'].', '.$val['date'].' '.$val['month'] }}</li>
                              @endforeach
                           </ul>
                        </div>
                        <div class='tab-content'>
                           @foreach($dates as $key => $val)
                              <div class="timings tab-pane {{ $loop->iteration==1 ? 'active' : ''}}" id="{{ $val['month'].'-'.$val['date'] }}" data-date="{{ $key }}">
                                 @if( isset($val['schedules']) )
                                    <ul class="list-inline">
                                       @foreach( $val['schedules'] as $schedule_id => $time )
                                          <li data-id="{{ $schedule_id }}">{{ $time }}</li>
                                       @endforeach
                                    </ul>
                                 @else
                                    <p>No times found.</p>
                                 @endif
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane step-data" id="step-2-data">
                  <div class="row">
                     <div class="col-md-8 offset-md-2 form-group">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Patient Details</h5>
                        <form action='' class="form-inline info-form" id='patient-info-form'>
                           <div class="input-group form-inputField">
                              <input type="text" class="form-control" id="name" placeholder="Name *" value="{{ Auth::check() ? $user->getFullName() : '' }}" required pattern="[a-zA-Z.\s]+" maxlength='50' title="Name should only contains characters, dots and spaces">
                           </div>
                           <div class="input-group form-inputField">
                              <input type="email" class="form-control" id="email" placeholder="Email" value="{{ Auth::check() ? $user->email : '' }}">
                           </div>
                           <div class="input-group form-inputField">
                              <input type="text" class="form-control numeric" id="phone" placeholder="Phone Number *" value="{{ Auth::check() ? $user->phone : '' }}" required maxlength='15'>
                           </div> 
                           <div class="col-md-12">
                              <button class="btn btn-xs btn-success" onclick="switchStep(1);" type="button"><span class="fa fa-long-arrow-left"></span> Previous</button>
                              <button class="btn btn-xs btn-success" id='save-patient-info' type="submit">Next  <span class="fa fa-long-arrow-right"></span></button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="tab-pane step-data" id="step-3-data">
                  <div class="row">
                     <div class="col-md-6 offset-md-3 form-group">
                        <span class='green otp-msg' id='otp-success'>A verification code has been sent to your mobile by SMS. Please enter the verification code.</span>
                        <span class='red otp-msg' id='otp-error'>Unable to send OTP. Please try again.</span>
                        <div class="input-group mtBottom-20 mt-10">
                           <input type="text" class="form-control" name='otp' id="otp" placeholder="Enter verification code(OTP)">
						      </div>
      				      <a href="#" class="resend-link" id='send-otp'>Resend OTP</a>
            			   <div class="col-md-12 mt-10">
                           <button class="btn btn-xs btn-success" onclick="switchStep(2);" type="button"><span class="fa fa-long-arrow-left"></span> Previous</button>
                           <button class="btn btn-xs btn-success" type="submit" id='schedule'>Schedule</button>
            				</div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane step-data" id="step-4-data">
                  <div class="row">
                     <div class=" col-md-6 offset-md-4 form-group">
                        <h5>Your Appointment is Fixed.</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="{{ url('assets/js/flexslider.js') }}"></script>
<script>
jQuery(function($){
   var json = {};
   json.slug = "<?php echo $provider->slug ?>";
   $('.flexslider').flexslider({
      animation: "slide",
      slideshow: false,
      animationLoop: false,
      itemWidth: 50,
      itemMargin: 0,
      minItems: 3,
      maxItems: 5,
      controlNav: false,
      keyboard: false
   });

   $('ul.slides li').click(function(){
      var timings = $(this).data('timings');
      $('ul.slides li').removeClass('active');
      $(this).addClass('active');
      $('.timings').hide();
      $('#'+timings).show();
   });

   $('.timings li').click(function(){
      $('.timings li').removeClass('active');
      $(this).addClass('active');
      json.schedule_id = $(this).data('id');
      json.book_datetime = $(this).closest('.tab-pane').data('date') + ' ' + $(this).html() + ':00';
      switchStep(2);
   });

   $('#patient-info-form').submit(function(e){
      e.preventDefault();
      var name = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      if( name && phone ) 
      {
         json.name = name;
         json.email = email;
         json.phone = phone;
         switchStep(3);
      }
   });

   // Send OTP
   $('#send-otp').click(function(){
      // sendOTP( json.phone );
   });

   // Save appointment
   var url = '/appointment/book';
   var _token = "<?php echo csrf_token(); ?>";
   $('#schedule').click(function(){
      var elem = $(this);
      if( $('#otp').length > 0 )
      {
         if( !$('#otp').val() ) {
            alert('Enter OTP to proceed');
            return;
         } else {
            json.otp = $('#otp').val();
         }
      }

      json._token = _token;
      elem.attr('disabled', true).html('Please wait...');
      $.post(url, json, function(response){
         response = $.parseJSON(response);
         if( response.status == 'success' ) {
             switchStep(4);
         } else {
            alert(response.message );
         }
         elem.attr('disabled', false).html('Schedule');
      });
   });
});

// Send OTP
function sendOTP(mobile)
{
   $('.otp-msg').hide();
   $.post('/otp/send', {mobile: mobile}, function(response){
      response = $.parseJSON(response);
      if( response.status == 'success' ) {
         $('#otp-success').show();
      } else {
         $('#otp-error').show();
      }
   });
}

function switchStep(n)
{   
   $('.steps').removeClass('active');
   for(var i=1; i<=n; i++) {
      $('#step-'+i).addClass('active');
   }
   $('.step-data').hide();
   $('#step-' + n + '-data').show();
}
</script>

@endsection