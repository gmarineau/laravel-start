<div class="btn-group">
  {!! Form::open(['method' => 'GET', 'url' => $url]) !!}
  {!! Form::submit(trans('general.edit'), $attributes) !!}
  {!! Form::close() !!}
</div>
