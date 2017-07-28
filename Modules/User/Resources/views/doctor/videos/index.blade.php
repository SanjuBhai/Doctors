@extends('user::layouts.doctor.default')

@section('title', 'Videos')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Videos <a href="{{ route('doctor.videos.add') }}" class='btn btn-sm btn-primary'>Add New</a></h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        @include('user::admin.filter')
        
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>Videos</strong>
                @if( $videos->total() )
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
                                <th>Video URL</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $videos->isEmpty() ) 
                                <tr><td colspan="5">No videos found.</td></tr>
                            @else
                                @foreach($videos as $key => $val)
                                    <tr>
                                        <td>{{ $val->title }}</td>
                                        <td>{{ $val->video_url }}</td>
                                        <td>
                                            <a href="{{ route('doctor.videos.edit', array('id' => $val->id)) }}">Edit</a> | 
                                            <a href="#" class='red delete' data-video="{{ $val->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $videos->appends(request()->all())->links() }}
    </div>
</div>

<script type='text/javascript'>
jQuery(function($){
    var url = "{{ route('doctor.videos.delete') }}";
    var _token = "{{ csrf_token() }}";
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        if( confirm('Are you sure you want to delete? This action can not be undone.') )
        {
            var video = $(this).data('video');
            var obj = $(this);
            $.post(url, {video: video, _token: _token}, function(response){
                if(response == 'true')
                {
                    obj.closest('tr').fadeOut('slow');
                    setTimeout( function() {
                        obj.closest('tr').remove();
                    }, 1000);
                    alert('Video deleted.');
                } else {
                    alert(response);
                }
            });
        }
    });
});
</script>
@stop