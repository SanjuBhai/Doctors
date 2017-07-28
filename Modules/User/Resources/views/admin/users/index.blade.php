@extends('user::layouts.admin.default')

@section('title', 'Users')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> Users <a href="{{ route('admin.users.add') }}" class='btn btn-sm btn-primary'>Add New</a></h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        
        @include('user::admin.filter')
        
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>Users</strong>
                @if( $users->total() )
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
                                <th>Address</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( $users->isEmpty() ) 
                                <tr><td colspan="5">No users found.</td></tr>
                            @else
                                @foreach($users as $key => $val)
                                    <tr>
                                        <td><a href="{{ route('admin.users.view', ['user_id' => $val->id]) }}" target='_blank'>{{ $val->getFullName() }}</a></td>
                                        <td><a href="mailto:{{ $val->email }}">{{ $val->email }}</a></td>
                                        <td>{{ $val->phone }}</td>
                                        <td>{{ $val->address }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', array('user_id' => $val->id)) }}">Edit</a> | 
                                            <a href="#" class='red delete' data-user="{{ $val->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach                        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $users->appends(request()->all())->links() }}
    </div>
</div>

<script type='text/javascript'>
jQuery(function($){
    var url = "{{ route('admin.users.delete') }}";
    var _token = "{{ csrf_token() }}";
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        if( confirm('Are you sure you want to delete? This action can not be undone.') )
        {
            var user = $(this).data('user');
            var obj = $(this);
            $.post(url, {user: user, _token: _token}, function(response){
                if(response == 'true')
                {
                    obj.closest('tr').fadeOut('slow');
                    setTimeout( function() {
                        obj.closest('tr').remove();
                    }, 1000);
                    alert('User deleted.');
                } else {
                    alert(response);
                }
            });
        }
    });
});
</script>
@stop