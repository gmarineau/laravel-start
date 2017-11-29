<!doctype html>
<html lang="{{ config('app.locale') }}">
  <head>
    <title>Hello, world!</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      @yield('content')
    </div>
    <!-- JS -->
    <script src="{{ asset('js/all.js') }}"></script>
  </body>
</html>
