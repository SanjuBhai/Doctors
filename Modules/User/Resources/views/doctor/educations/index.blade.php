@extends('user::layouts.doctor.default')

@section('title', 'Educations')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Educations <a href="{{ route('doctor.educations.add') }}" class='btn btn-sm btn-primary'>Add New</a></h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        @include('user::admin.filter')
        
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>Educations</strong>
                @if( $educations->total() )
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
                                <th>Title</th>
                                <th>Institute</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $educations->isEmpty() ) 
                                <tr><td colspan="5">No educations found.</td></tr>
                            @else
                                @foreach($educations as $key => $val)
                                    <tr>
                                        <td>{{ $val->title }}</td>
                                        <td>{{ $val->institute }}</td>
                                        <td>{{ $val->from_year }}</td>
                                        <td>{{ $val->to_year }}</td>
                                        <td>
                                            <a href="{{ route('doctor.educations.edit', array('id' => $val->id)) }}">Edit</a> | 
                                            <a href="#" class='red delete' data-education="{{ $val->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $educations->appends(request()->all())->links() }}
    </div>
</div>

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
});
</script>
@stop