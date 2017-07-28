@extends('user::layouts.doctor.default')

@section('title', 'Appointments')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Appointments </h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        @include('user::admin.filter')
        
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>Appointments</strong>
                @if( $appointments->total() )
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Booking Time</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $appointments->isEmpty() ) 
                                <tr><td colspan="5">No appointments found.</td></tr>
                            @else
                                @foreach($appointments as $key => $val)
                                    <tr>
                                        <td>{{ $val->name }}</td>
                                        <td><a href="mailto:{{ $val->email }}">{{ $val->email }}</a></td>
                                        <td>{{ $val->phone }}</td>
                                        <td>{{ $val->book_datetime }}</td>
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

        {{ $appointments->appends(request()->all())->links() }}
    </div>
</div>

<!-- <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js" type="text/javascript"></script> -->

<script type='text/javascript'>
jQuery(function($){
    var url = "{{ route('doctor.educations.delete') }}";
    var _token = "{{ csrf_token() }}";
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        if( confirm('Are you sure you want to delete? This action can not be undone.') )
        {
            var education = $(this).data('education');
            var obj = $(this);
            $.post(url, {education: education, _token: _token}, function(response){
                if(response == 'true')
                {
                    obj.closest('tr').fadeOut('slow');
                    setTimeout( function() {
                        obj.closest('tr').remove();
                    }, 1000);
                    alert('Education deleted.');
                } else {
                    alert(response);
                }
            });
        }
    });

    // $('#start_date').datetimepicker();
});
</script>
@stop