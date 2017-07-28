@extends('user::layouts.doctor.default')

@section('title', 'Change Password')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Change Password </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
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

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for='current_password'>Current Password *</label>
                <input type='password' class="form-control" id='current_password' name='current_password' required>
                @if ($errors->has('current_password'))
                    <p class="help-block">{{ $errors->first('current_password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='password'>New Password *</label>
                <input type='password' class="form-control" id='password' name='password' required>
                @if ($errors->has('password'))
                    <p class="help-block">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='password_confirmation'>Re-enter Password *</label>
                <input type='password' class="form-control" id='password_confirmation' name='password_confirmation' required>
                @if ($errors->has('password_confirmation'))
                    <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<script type="text/javascript">
activateMenu('menu-user');
</script>

@stop