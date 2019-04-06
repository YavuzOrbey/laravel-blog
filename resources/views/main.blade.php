@include('inc._head')
  <body>
    @include('inc._nav')

    <div class="container white mt-3 p-4 shadow">
      @include('inc._messages')
      @yield('content')
      <hr>
      <p class="text-center">Yavuz Orbey - Copyright {{ date('Y')}}</p>
    </div>
@include('inc._foot')