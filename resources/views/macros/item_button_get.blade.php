<div class="btn-group">
  {!! Form::open(['method' => 'GET', 'url' => $url]) !!}
  {!! Form::submit(trans($label), $attributes) !!}
  {!! Form::close() !!}
</div>
