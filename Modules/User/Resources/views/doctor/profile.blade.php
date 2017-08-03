@extends('user::layouts.doctor.default')

@section('title', 'Profile')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Profile </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control" id="name" required name='name' value="{{ $doctor->name }}" autofocus>
            </div>
            <div class="form-group">
                <label for="experience">Experience (years) *</label>
                <input type="text" class="form-control" id="experience" required name='experience' value="{{ $doctor->experience }}">
            </div>
            <div class="form-group">
                <label for="online_fees">Online Fees (Rs.) *</label>
                <input type="text" class="form-control numeric" id="online_fees" required name='online_fees' value="{{ $doctor->online_fees }}">
            </div>
            <div class="form-group">
                <label>Gender: </label>
                <label class="radio-inline" for='male'>
                    <input type="radio" name="gender" id="male" value="male" {{ $doctor->gender=='male'? 'checked' :''}}>Male
                </label>
                <label class="radio-inline" for='female'>
                    <input type="radio" name="gender" id="female" value="female" {{ $doctor->gender=='female'? 'checked' :''}}>Female
                </label>
            </div>
            <div class="form-group">
                <label for="personal_statement">Personal Statement</label>
                <textarea class="form-control" id="personal_statement" name='personal_statement' placeholder='Describe yourself..'>{{ $doctor->personal_statement }}</textarea>
            </div>

            <h3>Clinic Details</h3>
            <div class="form-group">
                <label for="clinic_name">Clinic Name *</label>
                <input type="text" class="form-control" id="clinic_name" required name='clinic_name' value="{{ $doctor->clinic_name }}">
            </div>
            <div class="form-group">
                <label for="clinic_phone">Clinic Phone *</label>
                <input type="text" class="form-control" id="clinic_phone" required name='clinic_phone' value="{{ $doctor->clinic_phone }}">
            </div>
            <div class="form-group">
                <label for="clinic_city">Clinic City *</label>
                <input type="text" class="form-control" id="clinic_city" required name='clinic_city' value="{{ $doctor->clinic_city }}">
            </div>
            <div class="form-group">
                <label for="clinic_locality">Clinic Locality *</label>
                <input type="text" class="form-control" id="clinic_locality" required name='clinic_locality' value="{{ $doctor->clinic_locality }}">
            </div>
            <div class="form-group">
                <label for="clinic_fees">Clinic Fees (Rs.) *</label>
                <input type="text" class="form-control numeric" id="clinic_fees" required name='clinic_fees' value="{{ $doctor->clinic_fees }}">
            </div>
            
            <h3>Social Links</h3>
            <div class="form-group">
                <label for="facebook_link">Facebook Link</label>
                <input type="url" class="form-control" id="facebook_link" name='facebook_link' value="{{ $doctor->facebook_link }}">
            </div>
            <div class="form-group">
                <label for="twitter_link">Twitter Link</label>
                <input type="url" class="form-control" id="twitter_link" name='twitter_link' value="{{ $doctor->twitter_link }}">
            </div>
            <div class="form-group">
                <label for="linkedin_link">Linkedin Link</label>
                <input type="url" class="form-control" id="linkedin_link" name='linkedin_link' value="{{ $doctor->linkedin_link }}">
            </div>
            <div class="form-group">
                <label for="googleplus_link">Google Plus Link</label>
                <input type="url" class="form-control" id="googleplus_link" name='googleplus_link' value="{{ $doctor->googleplus_link }}">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script type="text/javascript">
activateMenu('menu-user');
</script>

@stop