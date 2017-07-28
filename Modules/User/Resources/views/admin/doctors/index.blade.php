@extends('user::layouts.admin.default')

@section('title', 'Doctors')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Doctors </h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        @include('user::admin.filter')
        
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>Doctors</strong>
                @if( $doctors->total() )
                    <span class='pull-right'>
                        {{ $showing }}
                    </span>
                @endif
            </div>
            <div class='panel-body'>
                <div class='table-responsive'>
                    <table class="table table-bordered table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>Registration Number</th>
                                <th>Clinic Name</th>
                                <th>Clinic Fees</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $doctors->isEmpty() ) 
                                <tr><td colspan="6">No doctors found.</td></tr>
                            @else
                                @foreach($doctors as $key => $val)
                                    <tr>
                                        <td><a href="{{ route('admin.doctors.view', ['user_id' => $val->id]) }}" target='_blank'>{{ $val->prefix.' '.$val->name }}</a></td>
                                        <td>{{ $val->specialization }}</td>
                                        <td>{{ $val->medical_registration_number }}</a></td>
                                        <td>{{ $val->clinic_name }}</a></td>
                                        <td>{{ $val->clinic_fees }}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{ $doctors->appends(request()->all())->links() }}
    </div>
</div>

@stop