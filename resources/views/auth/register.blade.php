@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">Register</div>
        <div class="card-body">
          {{ Form::open(['route' => 'register']) }}

            <div class="form-group">
              {{ Form::label('first_name', 'First name') }}
              {{ Form::text('first_name', old('first_name'), ['class' => 'form-control']) }}
              @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
              @endif
            </div>

            <div class="form-group">
              {{ Form::label('last_name', 'Last name') }}
              {{ Form::text('last_name', old('last_name'), ['class' => 'form-control']) }}
              @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
              @endif
            </div>

            <div class="form-group">
              {{ Form::label('email', 'E-Mail') }}
              {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group">
              {{ Form::label('password', 'Password') }}
              {{ Form::password('password', ['class' => 'form-control']) }}
              @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>

            <div class="form-group">
              {{ Form::label('confirm_password', 'Confirm Password') }}
              {{ Form::password('confirm_password', ['class' => 'form-control']) }}
            </div>

            <button type="submit" class="btn btn-primary">
              Register
            </button>
           
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>

@endsection
