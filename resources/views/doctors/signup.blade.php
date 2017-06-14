@extends('layouts.app')

@section('title', 'Filter Results')

@section('content')

<div class="container pdTop-10">
   <div class="row">
      <div class="col-md-9 col-sm-9">
        <h1>{{ __('Register') }}</h1>
        {!! Form::model($doctor) !!}

          <div class="row form-group">
            <div class="col-md-2">
              {{ Form::select('prefix', $prefix, $doctor->prefix, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-10">
              {{ Form::text('name', $doctor->name, ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}
            </div>
          </div>


          <button type="submit" class="btn btn-default">Submit</button>

        {!! Form::close() !!}
      </div>
      @include('sidebar')
   </div>
</div>
@endsection