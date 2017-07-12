@extends('user::layouts.admin')

@section('title', 'Profile')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Profile </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @if(Session::has('success'))
            <div class='alert alert-success'>
                <i class='fa fa-check'></i> {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class='alert alert-danger'>
                <i class='fa fa-times'></i> {{ Session::get('error') }}
            </div>
        @endif

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" class="form-control" id="first_name" required name='first_name' autofocus value="{{ $user->first_name }}">
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required value="{{ $user->last_name }}">
            </div>
            
            <div class="form-group">
                <label for="phone">Contact No *</label>
                <input type="text" class="form-control" id="phone" required name="phone" value="{{ $user->phone }}">
            </div>
            
            {{ csrf_field() }}
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@stop