
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand nav-link" href="/">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('/') ? 'active': '' }}">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>


      <li class="nav-item {{ Request::is('blog') ? 'active': '' }}">
      <a class="nav-link" href="/blog/{{ Auth::user()? Auth::user()->username: '' }}">Blog</a>
      </li>

      <li class="nav-item {{ Request::is('about') ? 'active': '' }}">
      <a class="nav-link" href="/about">About</a>
      </li>
            
      <li class="nav-item {{ Request::is('contact') ? 'active': '' }}">
        <a class="nav-link" href="/contact">Contact</a>
      </li>
    </ul>

    {{-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> --}}
    
    <ul class="navbar-nav ">
      @guest
       <li class="nav-item dropleft">
        <a class="nav-link dropdown-toggle text-white" href="{{ route('login') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        
        <div class="dropdown-menu w-auto @if ($errors->has('email')) show @endif" aria-labelledby="navbarDropdown">
                          
        <form class="px-4 py-3" method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-group">
              <label for="email">{{ __('Email Address') }}</label>
              <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="email@example.com" value="{{ old('email') }}" autocomplete="off">
              
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Password" >
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
            
            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
          </form>
                        
          <div class="dropdown-divider"></div>
          
          <a class="dropdown-item btn btn-link" href="{{ route('register') }}">{{ __('Sign up') }}</a>
          
          @if (Route::has('password.request'))
          <a class=" dropdown-item btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
          @endif
        </div>
      </li>
      
      @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
      @endif
            
      @else
     
      <li class="nav-item dropleft ">
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->username }}
        <span id="notifications" v-bind:notifications="notifications">@{{notifications}}</span>
        </a>
        
        <div class="dropdown-menu w-auto" aria-labelledby="navbarDropdown">
          @if(Auth::user()->hasRole(['superadministrator', 'administrator']))
          <a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="dropdown-item" href="{{route('profile', ['username' => Auth::user()->username])}}">My Profile</a>
          <a class="dropdown-item" href="{{route('posts.index')}}">My Posts</a>
          <a class="dropdown-item" href="{{route('tags.index')}}">Tags</a>
          @endif
          <a class="dropdown-item" href="{{route('comments.index')}}">My Comments</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
      @endguest

    </ul>
  </div>
</nav>