@extends('layouts.app')

@section('content')
<div class="container mt-20">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <i class="fa fa-check"></i> {{ session('doctor-signup') }}
            </div>
        </div>
    </div>
</div>
@endsection
