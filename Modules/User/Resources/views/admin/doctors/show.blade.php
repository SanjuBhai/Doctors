@extends('user::layouts.admin.default')

@section('title', $user->getFullName())

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Doctor Details - {{ $user->getFullName() }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#user">User</a></li>
            <li><a data-toggle="tab" href="#doctor">Doctor</a></li>
        </ul>

        <div class="tab-content">
            <div id="user" class="tab-pane fade in active">
                @include('user::admin.users.user-data', array('user' => $user))
            </div>

            <div id="doctor" class="tab-pane fade">
                <div class='table-responsive'>
                    <table class="table table-stripped table-hover">
                        <tr>
                            <th width='300'>Name</th>
                            <td>
                                {{ $user->doctor->getFullName() }}
                                @if( $user->doctor->isApproved() )
                                    <span class="label label-success">Approved</span>
                                @else
                                    <span class="label label-danger">Not Approved</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Specialization</th>
                            <td>{{ $user->doctor->specialization->name }}</td>
                        </tr>
                        <tr>
                            <th>Medical Registration Number</th>
                            <td>{{ $user->doctor->medical_registration_number }}</td>
                        </tr>
                        <tr>
                            <th>Clinic Name</th>
                            <td>{{ $user->doctor->clinic_name }}</td>
                        </tr>
                        <tr>
                            <th>Clinic Fees</th>
                            <td>{{ $user->doctor->clinic_fees }}</td>
                        </tr>
                        <tr>
                            <th>Online Fees</th>
                            <td>{{ $user->doctor->online_fees }}</td>
                        </tr>
                        <tr>
                            <th>Clinic Phone</th>
                            <td>{{ $user->doctor->clinic_phone }}</td>
                        </tr>
                        <tr>
                            <th>Clinic City</th>
                            <td>{{ $user->doctor->clinic_city }}</td>
                        </tr>
                        <tr>
                            <th>Clinic Locality</th>
                            <td>{{ $user->doctor->clinic_locality }}</td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td>{{ $user->doctor->clinic_name }}</td>
                        </tr>
                        <tr>
                            <th>Personal Statement</th>
                            <td>{{ $user->doctor->personal_statement }}</td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td>{{ $user->doctor->experience.' years' }}</td>
                        </tr>
                        <tr>
                            <th>Facebook link</th>
                            <td>{{ $user->doctor->facebook_link }}</td>
                        </tr>
                        <tr>
                            <th>Twitter link</th>
                            <td>{{ $user->doctor->twitter_link }}</td>
                        </tr>
                        <tr>
                            <th>Linkedin link</th>
                            <td>{{ $user->doctor->linkedin_link }}</td>
                        </tr>
                        <tr>
                            <th>Google Plus link</th>
                            <td>{{ $user->doctor->googleplus_link }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop