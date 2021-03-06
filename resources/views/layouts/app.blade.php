<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yavuz Orbey') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            @include('inc._head')
            <body>
              @include('inc._nav')

              <div class="container white mt-3 p-4 shadow">
                    @include('inc._messages')
                    @yield('content')
                    <hr>
                    <p class="text-center">Yavuz Orbey - Copyright {{ date('Y')}}</p>
                  </div>
                </div>
              @include('inc._foot')

</body>
</html>
