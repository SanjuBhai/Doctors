@extends('user::layouts.admin.default')

@section('title', 'Settings')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Settings </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <form role="form" method='post' action=''>
            <div class="form-group">
              <label for="stripe_key">Stripe Key</label>
              <input type="text" class="form-control" id="stripe_key" name='stripe_key' value="{{$settings['stripe_key']}}">
            </div>
            <div class="form-group">
              <label for="admin_email">Admin Email</label>
              <input type="email" class="form-control" id="admin_email" name='admin_email' value="{{$settings['admin_email']}}">
            </div>
            <div class="form-group">
              <label for="care_email">Customer Care Email</label>
              <input type="email" class="form-control" id="care_email" name='care_email' value="{{$settings['care_email']}}">
            </div>
            <div class="form-group">
              <label for="facebook_link">Facebook Link</label>
              <input type="text" class="form-control" id="facebook_link" name="facebook_link"  value="{{$settings['facebook_link']}}">
            </div>
            <div class="form-group">
              <label for="twitter_link">Twitter Link</label>
              <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{$settings['twitter_link']}}">
            </div>
            <div class="form-group">
              <label for="google_plus_link">Google Plus Link</label>
              <input type="text" class="form-control" id="google_plus_link" name="google_plus_link" value="{{$settings['google_plus_link']}}">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@stop