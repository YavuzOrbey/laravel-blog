<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Yavuz Orbey</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? 'active': '' }}">
            <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active': '' }}">
            <a class="nav-link" href="/about">About</a>
            </li>
            
            <li class="nav-item {{ Request::is('contact') ? 'active': '' }}">
              <a class="nav-link" href="/contact">Contact</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          <ul class="navbar-nav">
              <li class="nav-item dropleft">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                  </a>
                  <div class="dropdown-menu w-auto" aria-labelledby="navbarDropdown">
                    <form class="px-4 py-3">
                      <div class="form-group">
                        <label for="exampleDropdownFormEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                      </div>
                      <div class="form-group">
                        <label for="exampleDropdownFormPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
                          Remember me
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">New around here? Sign up</a>
                    <a class="dropdown-item" href="#">Forgot password?</a>
                  </div>
              </li>
          </ul>
        </div>
      </nav>
      {{-- <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="#">PS1</a>
          <a class="p-2 text-muted" href="#">PS2</a>
          <a class="p-2 text-muted" href="#">PS3</a>
          <a class="p-2 text-muted" href="#">SNES</a>
          <a class="p-2 text-muted" href="#">N64</a>
          <a class="p-2 text-muted" href="#">GCN</a>
          <a class="p-2 text-muted" href="#">GBA</a>
          <a class="p-2 text-muted" href="#">NDS</a>
          <a class="p-2 text-muted" href="#">Wii</a>
          <a class="p-2 text-muted" href="#">Wii U</a>
        </nav>
      </div> --}}