@extends('user::layouts.admin.default')

@section('title', $user->getFullName())

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header"> User Details - {{ $user->getFullName() }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        @include('user::admin.messages')
        @include('user::admin.users.user-data', array('user' => $user))
    </div>
</div>

@stop