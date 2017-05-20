@section('content')
@foreach($doctors as $key => $val)
  <div class="row doctor-detailBox">
     <div class="col-sm-3"><a href="#"><img src="{{ $val->getImageUrl() }}" alt="" title="" width='100' height='120' class='avatar'></a></div>
        <div class="col-sm-5 doctor-profile">
           <a href="#" class="doctor-name">{{ $val->prefix.' '.$val->name }}</a>
           <p><strong> {{ $val->qualifications }}</strong></p>
           <span>{{ $val->specialization->name }}</span>
        </div>
        <div class="col-sm-4">
           <ul class="location-details">
              <li> <i class="fa fa-heart-o" aria-hidden="true"></i> 94%({{ $val->rating_count }} ratings)</li>
              <li> <i class="fa fa-briefcase" aria-hidden="true"></i> {{ $val->experience }} Years experience</li>
              <li> <i class="fa fa-money" aria-hidden="true"></i> ₹{{ $val->clinic_fees }} at clinic</li>
              <li><a href="#" class="" id=""> <i class="fa fa-clock-o" aria-hidden="true"></i> Available today</a></li>
              <li><strong>MON-FRI</strong> 3PM-9PM </li>
          </ul>
      </div>
      <div class="col-md-12">
          <div class="row detail-footer ">
              <!-- <div class="col-md-4"><a href="#" class="foot-link"><i class="fa fa-phone" aria-hidden="true"></i> Call Doctor</a></div>
              <div class="col-md-4"><a href="#" class="foot-link"><i class="fa fa-comments" aria-hidden="true"></i> Consult Online</a></div> -->
              <div class="col-md-4"><a href="#" class="foot-link"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Book Appointment</a></div>
          </div>
      </div>
  </div>
@endforeach