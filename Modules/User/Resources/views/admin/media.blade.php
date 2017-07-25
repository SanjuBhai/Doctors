@extends('user::layouts.admin')

@section('title', 'Media')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Media </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
		@include('user::admin.messages')        
    </div>
</div>

@stop