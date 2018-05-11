<div id="logo-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-9">
                <div id="logo"><a href="{{ url('/') }}"><img src="{{ asset('images/adhlogo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="col-sm-9 text-right">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#thrift-1"
                                aria-expanded="false"><span class="sr-only">Toggle Navigation</span> <span
                                    class="icon-bar"></span> <span class="icon-bar"></span> <span
                                    class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="thrift-1"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown" role="button"
                                                                           aria-haspopup="true"
                                                                           aria-expanded="false"></a>
                        <div id="nav_menu_list">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                @if($themenu)
                                    @foreach($themenu['content'] as $menu)
                                        <li id="{{ $menu['href'] }}"><a
                                                    href="{{ url('/'.$menu['href']) }}">{{ $menu['text'] }}</a></li>
                                    @endforeach
                                @else
                                    <li>Add Menu Item</li>
                                @endif
                                <span class="btn_item">
                                    @if (Auth::guest())
                                        <li>
                                        <button class="btn_login" data-toggle="modal"
                                                data-target="#login">Login</button>
                                        </li>
                                        <li>
                                        <button class="btn_register" data-toggle="modal" data-target="#register">Register</button>
                                        </li>
                                    @else
                                        <li>
                                            <a class="btn btn-info active" href="{{ route('my-profile.index') }}">
                                                My Profile
                                            </a>
                                        </li>
                                        <li>
                                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                                                class="btn_register btn-danger"><i
                                                    class="fa fa-power-off"></i> Logout</button>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                    @endif

                                </span>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>