@if(Session::has('success'))
    <div class='alert alert-success'>
        <i class='fa fa-check'></i> {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class='alert alert-danger'>
        <i class='fa fa-times'></i> {{ Session::get('error') }}
    </div>
@endif