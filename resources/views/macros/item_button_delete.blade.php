<div class="btn-group">
  {!! Form::open(['method' => 'DELETE', 'url' => $url, 'class' => 'form-delete-button', 'id' => 'delete-id-'. $id]) !!}
  {!! Form::submit(trans('general.delete'), $attributes) !!}
  {!! Form::close() !!}
</div>
