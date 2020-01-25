@include('inc._head')
  <body>
    @include('inc._nav')
    @include('inc._sidebar')
    <div class="container white mt-3 p-4">
      @include('inc._messages')
      @yield('content')
      <hr>
      <p class="text-center">Yavuz Orbey - Copyright {{ date('Y')}}</p>
    </div>
@include('inc._foot')