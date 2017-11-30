<div class="form-group{{ (!is_null($errors) && $errors->has($name)) ? ' has-error' : '' }}">
  {!! Form::label($name, empty($label) ? '' : $label, ['class' => 'control-label']) !!}
  <b>{!! $attributes['required'] ? ' <span class="text-danger">*</span>' : '' !!}</b>
  {!! Form::text($name, $value, $attributes) !!}
  @if (!empty($help))
    <p class="help-block">{{ $help }}</p>
  @endif
  {!! (!is_null($errors) && $errors->has($name) ? '<p class="help-block text-red">' . $errors->first($name) . '</p>' : '') !!}
</div>
