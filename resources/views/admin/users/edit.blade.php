@extends('layouts.admin')

@section('header')
  <h1>Users</h1>
@stop

@section('content')

  <div class="box">
    <div class="box-body">
      {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) }}
        @include('admin.users.form')
      {{ Form::close() }}
    </div>
  </div>

@stop