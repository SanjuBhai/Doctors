@extends('layouts.app')

@section('title', $doctor->prefix .' '. $doctor->name)

@section('content')

<div class="container pdTop-10">
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="row doctor-detailBox">
            <div class="col-sm-2">
               <span><img src="{{ $doctor->getImageUrl() }}" alt="{{ $doctor->prefix.' '.$doctor->name }}" title="{{ $doctor->prefix.' '.$doctor->name }}" width='140' height='140'></span>
            </div>
            <div class="col-sm-6 doctor-profile">
               <span class="doctor-name"> 
                  {{ $doctor->prefix .' '. $doctor->name }} 
                  <span class="rating-icon">
                     <i class="fa fa-heart green-h" aria-hidden="true">&nbsp;94% 
                     ({{ $doctor->rating_count }} ratings)</i>
                  </span>
               </span>
               <p><strong> {{ $doctor->qualifications }} </strong></p>
               <span> {{ $doctor->specialization->name }}, {{ $doctor->clinic_city }}</span>
               <div class="fee-details">
                  <span>{{ $doctor->experience }} Years Experience</span>
                  <span>₹{{ $doctor->clinic_fees }} at clinic</span>
                  <span>₹{{ $doctor->online_fees }} online</span>
               </div>
               <div class="contact-btn">
                  <a href="{{ route('book-appointment', array('doctor' => $doctor->slug) ) }}" class="book-btn" id="book-now">Book Appointment</a>
                  <!-- <a href="#" class="consult-btn" id="consult-now">Consult Online</a>
                  <a href="#" class="call-btn" id="call-now" data-toggle="modal" data-target="#exampleModal">Call Now</a> -->
               </div>
            </div>
            <div class="col-sm-4 report-issue">
               <a href="#" class="feedback-btn" id="consult-now" data-toggle="modal" data-target="#exampleModal" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Submit Feedback</a>
               <a href="#" class="issue-btn" id="call-now" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-flag" aria-hidden="true"></i> Report Issue</a>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="details-grid mtBottom-20">
   <div class="container">
      <div class="row">
         <div class="col-md-4 sidebar-info">
            <div class="widgets">
               <span class="info-heading">Info</span>
               <ul class="info-view">
                  <li>
                     <h4 class="info-heading"><i class="fa fa-user" aria-hidden="true"></i>Specialty</h4>
                     <span>{{ $doctor->specialization->name }}</span>
                  </li>
                  <li>
                     <h4 class="info-heading"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Education</h4>
                     <span>MBBS - LLRM Medical College, Meerut - 1995 Diploma in Venerology &amp; Dermatology (DVD) - KMC Manipal - 2002</span>
                  </li>
                  <li>
                     <h4 class="info-heading"><i class="fa fa-globe" aria-hidden="true"></i>Languages spoken</h4>
                     <span>English ,Hindi</span>
                  </li>
                  <li>
                     <h4 class="info-heading"><i class="fa fa-trophy" aria-hidden="true"></i>Awards and Recognitions</h4>
                     <span>DVD from KMC Manipal - 2002</span>
                  </li>
                  <li>
                     <h4 class="info-heading"><i class="fa fa-id-card" aria-hidden="true"></i>Professional Memberships</h4>
                     <span>Indian Association of Dermatologists Venereologists and Leprologists (IADVL) <br/> Cosmetic Society of India (CSI) <br/> Delhi Medical Association (DMA)</span>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-md-8">
            <span class="info-heading">Review</span>
            <!-- Nav tabs -->
            <div class="card doctorDetail-tabs">
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Overview</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Doctors</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Feedback</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Services</a>
                  </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="home" role="tabpanel">
                     <p><b>About Smiling Mumbai Dental Clinics</b>Smiling Mumbai Dental Clinics's mission is to provide personalized, high-quality care on an as-needed or preventative basis. We have created a practice that we believe in and choose for our own family members.We are a full-service family practice of dedicated, experienced dentist who believe in word.
                     <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                     <a href="#">more..</a></p>
                  </div>
                  <div class="tab-pane" id="profile" role="tabpanel">
                     <p><b>About Smiling Mumbai Dental Clinics</b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                     <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using . </p>
                  </div>
                  <div class="tab-pane" id="messages" role="tabpanel">
                     <p><b>About Smiling Mumbai Dental Clinics</b>Smiling Mumbai Dental Clinics's mission is to provide personalized, high-quality care on an as-needed or preventative basis. We have created a practice that we believe in and choose for our own family membersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                  </div>
                  <div class="tab-pane" id="settings" role="tabpanel">
                     <p><b>About Smiling Mumbai Dental Clinics</b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                     <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--pop model start here....-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please Fill Your Deatils</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="form-group">
                  <label for="recipient-name" class="form-control-label">Name:</label>
                  <input type="text" class="form-control" id="recipient-name">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="form-control-label">Email:</label>
                  <input type="text" class="form-control" id="recipient-name">
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="form-control-label">Phone:</label>
                  <input type="text" class="form-control" id="recipient-name">
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Send message</button>
         </div>
      </div>
   </div>
</div>

@endsection