<header class="hero is-light">
    <div class="hero-head">
      <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">

          <a class="navbar-item is--brand" href="{{ url('/360admin') }}">
            <img class="navbar-brand-logo" src="{{asset('admin/images/adhlogo.png')}}" alt="Bulma Admin Template logo">
          </a>

          &nbsp;<a class="navbar-item" target="_blank" href="{{ url('/') }}">View Front</a>
          <!-- <a class="navbar-item is-tab is-hidden-mobile is-active"><span class="icon is-medium"><i class="fa fa-home"></i></span>Home</a>
          <a class="navbar-item is-tab is-hidden-mobile">Features</a>
          <a class="navbar-item is-tab is-hidden-mobile">Pricing</a>
          <a class="navbar-item is-tab is-hidden-mobile">About</a> -->
          
          <button class="button navbar-burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
          </button>

        </div>


        <div class="navbar-menu navbar-end" id="navMenu">
          <a class="navbar-item is-tab is-hidden-tablet is-active">Home</a>
          <a class="navbar-item is-tab is-hidden-tablet">Features</a>
          <a class="navbar-item is-tab is-hidden-tablet">Pricing</a>
          <a class="navbar-item is-tab is-hidden-tablet">About</a>
          
          <!-- <a class="navbar-item nav-tag">            
            <span class="icon is-small">
              <i class="fa fa-envelope-o"></i>
            </span>
            <span class="tag is-primary tag-notif">6</span>
          </a>  
          -->

          <!-- Authentication Links -->
                        @if (Auth::guest())
                            <a class="navbar-item" href="{{ route('admin.login') }}">Login</a>
                            <!-- <a class="navbar-item" href="{{ route('register') }}">Register</a> -->
                        @else
                            
                                <a class="navbar-item" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} logged in <span class="caret"></span>
                                </a>

                                <!-- <a class="navbar-link">              
                                  <figure class="image is-32x32" style="margin-right:.5em;">
                                    <img src="https://avatars1.githubusercontent.com/u/7221389?v=4&s=32">
                                  </figure>
                                </a> -->

                               <div class="navbar-item has-dropdown is-hoverable">
                                
                                <a class="navbar-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="icon is-small">
                                      <i class="fa fa-power-off"></i>
                                    </span>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                    
                              </div>  
                            
                        @endif


          </div>
        </div>
      </nav>
    </div>
  </header>