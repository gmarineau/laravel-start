<div class="checkbox">
  <label>
    {!! Form::hidden($name, 0) !!}
    {!! Form::checkbox($name, 1, isset($notification) ? $notification->{$name} : NULL) !!}
    {!! $label !!}
  </label>
</div>
