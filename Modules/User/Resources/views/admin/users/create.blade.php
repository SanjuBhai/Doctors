@extends('user::layouts.admin.default')

@section('title', 'Create user')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Create user </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for='first_name'>First Name *</label>
                <input type='text' class="form-control" id='first_name' name='first_name' value="{{ request('first_name') }}">
                @if ($errors->has('first_name'))
                    <p class="help-block red">{{ $errors->first('first_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='last_name'>Last Name *</label>
                <input type='text' class="form-control" id='last_name' name='last_name' required value="{{ request('last_name') }}">
                @if ($errors->has('last_name'))
                    <p class="help-block red">{{ $errors->first('last_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='email'>Email *</label>
                <input type='email' class="form-control" id='email' name='email' required value="{{ request('email') }}">
                @if ($errors->has('email'))
                    <p class="help-block red">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='phone'>Phone</label>
                <input type='text' class="form-control" id='phone' name='phone' value="{{ request('phone') }}">
                @if ($errors->has('phone'))
                    <p class="help-block red">{{ $errors->first('phone') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='address'>Address</label>
                <textarea class="form-control" id='address' name='address'>{{ request('address') }}</textarea>
                @if ($errors->has('address'))
                    <p class="help-block red">{{ $errors->first('address') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='password'>New Password *</label>
                <input type='password' class="form-control" id='password' name='password' required>
                @if ($errors->has('password'))
                    <p class="help-block red">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='password_confirmation'>Re-enter Password *</label>
                <input type='password' class="form-control" id='password_confirmation' name='password_confirmation' required>
                @if ($errors->has('password_confirmation'))
                    <p class="help-block red">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script type="text/javascript">
activateMenu('menu-user');
</script>

@stop