<div class="form-group">
  {{ Form::label('email', 'E-mail') }}
  {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
  <span class="text-danger">{{ $errors->first('email') }}</span>
</div>
<div class="form-group">
  {{ Form::label('first_name', 'First name') }}
  {{ Form::text('first_name', old('first_name'), ['class' => 'form-control']) }}
  <span class="text-danger">{{ $errors->first('first_name') }}</span>
</div>
<div class="form-group">
  {{ Form::label('last_name', 'Last name') }}
  {{ Form::text('last_name', old('last_name'), ['class' => 'form-control']) }}
  <span class="text-danger">{{ $errors->first('last_name') }}</span>
</div>
<div class="form-group">
  {{ Form::label('roles', 'Roles') }}
  {{ Form::select('roles[]', $roles, $user->roles->pluck('id')->toArray(), ['class' => 'form-control', 'multiple' => TRUE]) }}
</div>
<button type="submit" class="btn btn-primary">
  Edit
</button>