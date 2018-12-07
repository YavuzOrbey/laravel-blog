@include('inc._head')
  <body>
    @include('inc._nav')
    <div class="container">
            @yield('content')
            <hr>
            <p class="text-center">Yavuz Orbey - Copyright 2018</p>
    </div>
@include('inc._foot')