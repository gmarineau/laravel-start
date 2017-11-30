<div class="form-group{{ (!is_null($errors) && $errors->has($name)) ? ' has-error' : '' }}">

  {!! Form::label($name, $label, ['class' => 'control-label']) !!}
  <b>{!! $attributes['required'] ? ' <span class="text-danger">*</span>' : '' !!}</b>
  @foreach ($options as $value => $text)
    <div class="radio">
      <label>
        {!! Form::radio($name, $value, NULL, ['id' => 'optionsRadios'. $value]) !!}
        {{ $text }}
      </label>
    </div>
  @endforeach

  @if (!empty($help))
    <p class="help-block">{{ $help }}</p>
  @endif
  {!! (!is_null($errors) && $errors->has($name) ? '<p class="help-block text-red">' . $errors->first($name) . '</p>' : '') !!}

</div>
