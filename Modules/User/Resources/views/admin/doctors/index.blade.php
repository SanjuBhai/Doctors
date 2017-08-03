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
                                <th>Email</th>
                                <th>Phone</th>
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
                                        <td><a href="mailto:{{ $val->email }}">{{ $val->email }}</a></td>
                                        <td>{{ $val->phone }}</td>
                                        <td>
                                            @if( $val->status==1 )
                                                <span class='label label-success'>Verfied</span>
                                            @else
                                                <input type='button' class='btn btn-sm btn-primary verify' value='Verify' data-doctor="{{ $val->id }}">
                                            @endif
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

<script type='text/javascript'>
jQuery(function($){
    var url = "{{ route('admin.doctors.verify') }}";
    var _token = "{{ csrf_token() }}";
    $(document).on('click', '.verify', function(e){
        e.preventDefault();
        if( confirm('Are you sure you want to verify?') )
        {
            var doctor = $(this).data('doctor');
            var obj = $(this); obj.attr('disabled', true).val('Please wait...');
            $.post(url, {id: doctor, _token: _token}, function(response){
                if(response == 'true') {
                    obj.replaceWith('<span class="label label-success">Verified</span>');
                } else {
                    obj.attr('disabled', false).val('Verify');
                    alert(response);
                }
            });
        }
    });
});
</script>
@stop