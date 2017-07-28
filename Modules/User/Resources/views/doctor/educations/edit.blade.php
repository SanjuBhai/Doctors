@extends('user::layouts.doctor.default')

@section('title', 'Edit education')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Edit education </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for='title'>Title *</label>
                <input type='text' class="form-control" id='title' name='title' value="{{ request('title') ? request('title') : $education->title }}" required>
                @if ($errors->has('title'))
                    <p class="help-block red">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='institute'>Institute *</label>
                <input type='text' class="form-control" id='institute' name='institute' required value="{{ request('institute') ? request('institute') : $education->institute }}">
                @if ($errors->has('institute'))
                    <p class="help-block red">{{ $errors->first('institute') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='from_year'>From (year) *</label>
                <input type='text' class="form-control numeric" id='from_year' name='from_year' required value="{{ request('from_year') ? request('from_year') : $education->from_year }}" maxlength='4'>
                @if ($errors->has('from_year'))
                    <p class="help-block red">{{ $errors->first('from_year') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='to_year'>To (year) *</label>
                <input type='text' class="form-control numeric" id='to_year' name='to_year' required value="{{ request('to_year') ? request('to_year') : $education->to_year }}" maxlength='4'>
                @if ($errors->has('to_year'))
                    <p class="help-block red">{{ $errors->first('to_year') }}</p>
                @endif
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script type="text/javascript">
activateMenu('menu-education');
</script>

@stop