@extends('layouts.app')

@section('title', 'Doctor Signup')

@section('content')

<div class="main">
   <div class="banner-wrap">
      <div class="container">
          <form action='' method='post'>
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="pwd">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
      </div>
   </div>
</div>
@endsection