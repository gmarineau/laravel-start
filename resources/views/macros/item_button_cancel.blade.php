<div class="btn-group">
  {!! Form::open(['method' => 'POST', 'url' => $url, 'class' => 'form-cancel-button', 'id' => 'cancel-id-'. $id]) !!}
  {!! Form::submit(trans('general.cancel'), $attributes) !!}
  {!! Form::close() !!}
</div>
