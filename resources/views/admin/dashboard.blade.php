@extends('layouts.admin')

@section('breadcrumb', Breadcrumbs::render('dashboard'))

@section('content')

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-area-chart"></i> Area Chart Example
    </div>
    <div class="card-body">
      <p>Pellentesque posuere. Fusce a quam. Pellentesque dapibus hendrerit tortor. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Fusce fermentum odio nec arcu.</p>
      <p>Vivamus quis mi. Fusce vel dui. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Aenean viverra rhoncus pede. Aenean commodo ligula eget dolor.</p>
      <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Fusce commodo aliquam arcu. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Praesent turpis. Suspendisse non nisl sit amet velit hendrerit rutrum.</p>
    </div>
  </div>

@stop