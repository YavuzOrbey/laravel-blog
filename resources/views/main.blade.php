

@include('inc._head')

  <body>
    <div id="app">
    @include('inc._nav')
    @include('inc._sidebar')
    <div class="container white">
      @include('inc._messages')
      @yield('content')
      <hr>
      <p class="text-center">Yavuz Orbey - Copyright {{ date('Y')}}</p>
    </div>
  </div>
@include('inc._foot')
