<div class="btn-group">
  {!! Form::open(['method' => 'GET', 'url' => $url]) !!}
  {!! Form::submit(trans('general.create'), $attributes) !!}
  {!! Form::close() !!}
</div>
