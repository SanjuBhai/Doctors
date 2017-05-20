@extends('layouts.app')

@section('title', 'Filter Results')

@section('content')

<div class="container pdTop-10">
   <div class="row">
      <div class="col-md-3 col-sm-12">
         @include('filters', array('specializations' => $specializations))
      </div>
      <div class="col-md-6 col-sm-12">
         <div id='loader' class="alert alert-info text-center">
            Loading...
         </div>
         <div id='results'>
            
         </div>
      </div>
      @include('sidebar')
   </div>
</div>
@endsection