@extends('user::layouts.admin')

@section('title', $user->getFullName())

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> User Details - {{ $user->getFullName() }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <div class='table-responsive'>
            <table class="table table-stripped table-hover">
                <tr>
                    <th width='200'>&nbsp;</th>
                    <th><img src="{{ $user->getImageUrl() }}" width='80' height="80"></th>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>{{ $user->state }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $user->city }}</td>
                </tr>
                <tr>
                    <th>Street Address</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>Email Verified</th>
                    <td>{{ $user->is_email_verified ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Registered on</th>
                    <td>{{ $user->device_type }}</td>
                </tr>
                <tr>
                    <th>Registered on IP address</th>
                    <td>{{ $user->ip_address }}</td>
                </tr>
                <tr>
                    <th>Registered on User Agent</th>
                    <td>{{ $user->user_agent }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@stop