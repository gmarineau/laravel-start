@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          {{ Form::open(['route' => 'login']) }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {{ Form::label('email', 'E-mail') }}
              {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
              @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {{ Form::label('password', 'Password') }}
              {{ Form::password('password', ['class' => 'form-control']) }}
              @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}> Remember Me
              </label>
            </div>
            <button type="submit" class="btn btn-primary">
              Login
            </button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
              Forgot Your Password?
            </a>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>

@endsection
