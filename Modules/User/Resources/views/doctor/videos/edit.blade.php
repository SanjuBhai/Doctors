@extends('user::layouts.doctor.default')

@section('title', 'Edit video')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Edit video </h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')

        <form role="form" method='post' action=''>
            <div class="form-group">
                <label for='title'>Title *</label>
                <input type='text' class="form-control" id='title' name='title' value="{{ request('title') ? request('title') : $video->title }}" required>
                @if ($errors->has('title'))
                    <p class="help-block red">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for='video_url'>Video URL *</label>
                <input type='text' class="form-control" id='video_url' name='video_url' required value="{{ request('video_url') ? request('video_url') : $video->video_url }}">
                @if ($errors->has('video_url'))
                    <p class="help-block red">{{ $errors->first('video_url') }}</p>
                @endif
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

<script type="text/javascript">
activateMenu('menu-video');
</script>

@stop