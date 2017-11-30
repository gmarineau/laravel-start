<div class="form-group{{ (!is_null($errors) && $errors->has($name)) ? ' has-error' : '' }}">
  {!! Form::label($name, $label, ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    <div class="checkbox">
      <label>
        {!! Form::hidden($name, 0) !!}
        {!! Form::checkbox($name, $value, $checked, $attributes) !!}
      </label>
      @if (!empty($help))
        <p class="help-block">{{ $help }}</p>
      @endif
      {!! (!is_null($errors) && $errors->has($name) ? '<p class="help-block text-red">' . $errors->first($name) . '</p>' : '') !!}
    </div>
  </div>
</div>
