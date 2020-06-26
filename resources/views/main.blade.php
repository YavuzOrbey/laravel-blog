

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
      {{-- <user-chat v-if="chat"></user-chat> --}}
    </div>

@include('inc._foot')
