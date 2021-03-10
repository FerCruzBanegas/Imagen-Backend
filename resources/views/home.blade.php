<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PVI</title>
        {{-- <link rel="shortcut icon" href="{{{ asset('img/img2.png') }}}"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('fonts/font-icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-linearicons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-linearicons/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-feathericons/dist/feather.css') }}">
    </head>
    <body>
      <div id="app">
      </div>
      @include('scripts')
    </body>
</html>


