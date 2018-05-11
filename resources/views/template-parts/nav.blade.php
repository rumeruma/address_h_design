<div class="top-bar-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 hidden-xs">
                <div class="top-bar-socials">
                    @foreach(get_site_option('social-links') as $sl)
                        <a target="_blank" href="{{ $sl['url'] }}" class="social-icon-sm si-dark si-gray-round si-colored-{{$sl['type']}}">
                            <i class="fa fa-{{ $sl['type'] }}"></i>
                            <i class="fa fa-{{ $sl['type'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6 text-right">
                <ul class="list-inline top-dark-right">
                    <li class="hidden-sm hidden-xs"><i class="fa fa-envelope"></i> addresshelp360@gmail.com</li>
                    <li class="hidden-sm hidden-xs"><i class="fa fa-phone"></i> +88 01937 130 222</li>
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user"></i> Sign Up</a></li>
                    @else
                        <li><a href="{{ route('my-profile.index') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                                        class="fa fa-power-off"></i> Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                    <li><a class="topbar-icons" href="#"><span><i class="fa fa-search top-search"></i></span></a></li>
                </ul>
                <div class="search">
                    <form role="form" method="GET" action="{{ route('search') }}">
                        <input type="text" class="form-control" autocomplete="off" name="search" placeholder="Write something and press enter">
                        <span class="search-close"><i class="fa fa-times"></i></span>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div><!--top-bar-dark end here-->
<!--navigation -->
<!-- Static navbar -->
<div class="navbar navbar-default navbar-static-top yamm sticky" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="" href="{{ url('/') }}"><img src="{{ asset('c-profile') }}/img/new-img/adhlogo.png" alt="" height="50px" width="180px"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                {{--<li class="dropdown active ">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Home </a>--}}
                {{--</li>--}}
                {{--<li class="dropdown active ">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us </a>--}}
                {{--</li>--}}
                {{--<li class="dropdown active ">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact Us </a>--}}
                {{--</li>--}}
                {{--<li class="dropdown active ">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Career </a>--}}
                {{--</li>--}}

                @if($themenu)
                    @foreach($themenu['content'] as $menu)
                        <li id="{{ $menu['href'] }}" class="dropdown">
                            <a href="{{ url('/'.$menu['href']) }}" class="dropdown-toggle" >
                                {{ $menu['text'] }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>Add Menu Item</li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->
</div><!--navbar-default-->
<!--rev slider start-->