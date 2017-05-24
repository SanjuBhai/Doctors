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
         <div id='zeroresults' class='alert alert-danger' style="display: none;">No results found.</div>
         <div id='results'>
            
         </div>
         <div class="clearfix"></div>
         <div id='loadMore' style='display: none;'>
            <button type="button" class="btn btn-primary pointer">Show more</button>
         </div>
      </div>
      @include('sidebar')
   </div>
</div>
@endsection