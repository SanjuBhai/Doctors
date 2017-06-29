@extends('layouts.app')

<div class="container pdTop-10 ">
   <div class="row">
      <div class="col-md-12 col-sm-12">
         <div class="row doctor-detailBox">
            <div class="col-sm-2"><span><img src="assets/images/doctor-img.jpg" alt="" title=""></span></div>
            <div class="col-sm-6 doctor-profile">
               <span class="doctor-name"> Dr. Sandesh Gupta <span class="rating-icon"><i class="fa fa-heart green-h" aria-hidden="true">&nbsp;94%</i> (2403 ratings)</i></span></span>
               <p><strong> MBBS, Diploma in Venerology & Dermatology (DVD)</strong></p>
               <span> Dermatologist,New Delhi</span>
               <div class="fee-details">
                  <span>·  ₹300 at clinic</span>
               </div>
            </div>
         </div>
      </div>
      <div class=" col-md-12 stepwizard">
         <div class="stepwizard-row">
            <div class="stepwizard-step">
               <a class="btn btn-default btn-circle active-step" href="#step-1" data-toggle="tab" onclick="stepnext(1)" >1</a>
               <p>Appointment Info</p>
            </div>
            <div class="stepwizard-step">
               <a class="btn btn-default btn-circle" disabled="disabled" href="#step-2" data-toggle="tab">2</a>
               <p>Patient Info</p>
            </div>
            <div class="stepwizard-step">
               <a class="btn btn-default btn-circle" disabled="disabled" href="#step-3" data-toggle="tab">3</a>
               <p>Verify Mobile Number</p>
            </div>
            <div class="stepwizard-step">
               <a class="btn btn-default btn-circle" disabled="disabled" href="#step-4" data-toggle="tab">4</a>
               <p>Finished!</p>
            </div>
         </div>
         <div class="row rate-updates">
            <div class=" col-md-12 tab-content">
               <div class=" text-center tab-pane fade active in" id="step-1">
                  <button class="btn btn-xs btn-success" onclick="stepnext(2);" type="button">Next <span class="fa fa-long-arrow-right" ></span></button>
               </div>
               <div class="tab-pane fade " id="step-2">
                  <div class="row">
                     <div class="col-md-6 offset-md-3 form-group">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Patient Details</h5>
                        <form class="form-inline info-form">
                           <div class="input-group form-inputField">
                              <input type="text" class="form-control" id="inlineFormInput" placeholder="Name">
                           </div>
                           <div class="input-group form-inputField">
                              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Email">
                           </div>
                           <div class="input-group form-inputField">
                              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Phone Number">
                           </div>
                           <div class="input-group">
                              <label class="custom-control custom-radio">
                              <input id="radio1" name="radio" type="radio" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Male</span>
                              </label>
                              <label class="custom-control custom-radio">
                              <input id="radio2" name="radio" type="radio" class="custom-control-input">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Female</span>
                              </label>
                           </div>
                           <div class="col-md-12">
                              <button class="btn btn-xs btn-success" onclick="stepnext(1);" type="button">Previous  <span class="fa fa-long-arrow-right"></span></button>  
                              <button class="btn btn-xs btn-success" onclick="stepnext(3);" type="button">Next  <span class="fa fa-long-arrow-right"></span></button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade " id="step-3" >
                  <div class="row">
                     <div class=" col-md-6 offset-md-3 form-group">
                        <span>A verification code has been sent to your mobile 8932065701 by SMS. Please enter the verification code.</span>
                        <div class="input-group mtBottom-20 mt-10">
                           <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter verification code(OTP)">
						</div>
					 <a href="#" class="resend-link">Resend OTP</a>
					 <div class="col-md-12 mt-10">
                        <button class="btn btn-xs btn-success" onclick="stepnext(3);" type="button">Previous  <span class="fa fa-long-arrow-right"></span></button>  
                        <button class="btn btn-xs btn-success" onclick="stepnext(4);" type="button">Submit <span class="fa fa-long-arrow-right"></span></button>
					 </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade " id="step-4" >
                  <div class="row">
                     <div class=" col-md-6 offset-md-4 form-group">
                        <h5>Your Appointment is Fix</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
