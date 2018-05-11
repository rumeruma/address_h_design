<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>address help 360</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('c-profile') }}/img/new-img/faviconfinal.png">
    <!-- Bootstrap -->
    <link href="{{ asset('c-profile') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome for icons -->
    <link href="{{ asset('c-profile') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- animated css  -->
    <link href="{{ asset('c-profile') }}/css/animate.css" rel="stylesheet" type="text/css" media="screen">
    <!-- Revolution Style-sheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('c-profile/') }}rs-plugin/css/settings.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('c-profile') }}/css/rev-style.css">
    <!--cube css-->
    <link href="{{ asset('c-profile') }}/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css">
    <!-- custom css-->
    <link href="{{ asset('c-profile') }}/css/style.css" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('c-profile') }}/css/magnific-popup.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edit.css') }}" rel="stylesheet">
</head>
<body>
@php
    $links = posts_meta(get_metaext($post->meta), 'links');

    $contactmeta = posts_meta(get_metaext($post->meta), 'contacts');
    $contact = "not available";
    if(isset($contactmeta)){
        foreach ($contactmeta as $cont){
                if($cont['type'] == 'office'){ $contact = $cont['number']; }
        }
    }

    $sliders = posts_meta(get_metaext($post->meta), 'slider');
    $services = posts_meta(get_metaext($post->meta), 'services');
    $branches = posts_meta(get_metaext($post->meta), 'branches');
    $businessHours = posts_meta(get_metaext($post->meta), 'business_hours');
    $days = ["MON","TUE","WED","THU","FRI","SAT","SUN"];
    $vdos = posts_meta(get_metaext($post->meta), 'vdo');
    $geolocation = posts_meta_collection_get($post->meta,'info','geolocation')

@endphp
<input id="geoLocation" type="hidden" value="{{ $geolocation }}">
<div class="top-bar-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 hidden-xs">
                <div class="top-bar-socials">
                    @foreach($links as $link)
                        <a href="{{ $link['url'] }}"
                           class="social-icon-sm si-dark si-gray-round si-colored-{{ $link['type'] }}">
                            <i class="fa fa-{{ $link['type'] }}"></i>
                            <i class="fa fa-{{ $link['type'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>


            <div class="col-sm-6 text-right">
                <ul class="list-inline top-dark-right">
                    <li class="hidden-sm hidden-xs"><i
                                class="fa fa-envelope"></i>{{ posts_meta_collection_get($post->meta,'info','email') }}
                    </li>
                    <li class="hidden-sm hidden-xs"><i class="fa fa-phone"></i> {{ $contact }}</li>
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
                    <form role="form">
                        <input type="text" class="form-control" autocomplete="off"
                               placeholder="Write something and press enter">
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
            <a class="" href="{{ route('home') }}"><img src="{{ asset('c-profile') }}/img/new-img/adhlogo.png"
                                                        alt="logo" height="50px" width="180px"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown active ">
                    <a href="#">Home</a>
                </li>
                <!--menu home li end here-->
                <li class="dropdown">
                    <a href="#about">About Us</a>
                </li>
                <!--menu Portfolio li end here-->
                <li class="dropdown">
                    <a href="#service">Service</a>

                </li>
                <li class="dropdown">
                    <a href="#contact">Contact Us</a>

                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--container-->
</div>

<div class="details-lt-block">
    <div class="user_cover_photo"><img src="{{ posts_featured_image_uri($post->meta, 'image') }}" alt="cover"
                                       height="520px" width="100%"></div>
    <div class="container header_slt_block">
        <div class="slt_item_head">
            <div class="user_logo_pic"><img alt="" src="{{ posts_featured_image_uri($post->meta, 'logo') }}"></div>
            <div class="slt_item_contant">
                <h1>{{ $post->title }}</h1>
                <p class="location">
                    <i class="fa fa-map-marker"></i> {{ posts_meta_collection_get($post->meta,'info','address') }}
                </p>
                <div class="rating-box">
                    <div class="rating">
                        <span class="slogan">"&nbsp;{{ posts_meta_collection_get($post->meta,'info','tagline') }}
                            "</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="about"><br>
    <div class="divide60"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="center-heading">
                    <h2>ABOUT <strong>US</strong></h2>
                    <span class="center-line"></span><br>
                    <div>
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div><!--center heading end-->
    </div>
</div><!--services container-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="center-heading">
                <h2>IMAGE <strong>GALLey</strong></h2>
                <span class="center-line"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @if(isset($sliders))
                    @foreach($sliders as $slider)
                        <div class="col-md-4 col-sm-6">
                            <div class="cbp-item web-design">
                                <a class="cbp-caption cbp-lightbox"
                                   href="{{ $slider }}">
                                    <div class="cbp-caption-defaultWrap">
                                        <img src="{{ $slider }}" alt="image">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="divide60"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="center-heading">
                <h2>BUSINESS <strong>DESCRIPTION</strong></h2>
                <span class="center-line"></span><br>
                <div class="sub-text margin40"> {!! $post->excerpt !!} </div>
            </div>
        </div>
    </div><!--center heading end-->
</div>
<div id="service"><br>
    <div class="divide50"></div>
    <div class="wide-img-showcase">

        <div class="row margin-0 wide-img-showcase-row">
            <div class="col-sm-6 no-padding  img-2 ">
                <div class="no-padding-inner ">
                    <div>&nbsp;</div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-6 no-padding gray">
                <div class="no-padding-inner gray">
                    <h3 class="wow animated fadeInDownfadeInRight">BUSINESS <span class="colored-text">SERVICE</span>
                    </h3>
                    @if(isset($services))
                        @foreach($services as $service)
                            <div class="services-box margin30 wow animated fadeInRight">
                                <div class="services-box-icon">
                                    <i class="fa fa-check"></i>
                                </div><!--services icon-->
                                <div class="services-box-info">
                                    <h4>{{ $service['text'] }}</h4>
                                </div>
                            </div><!--service box-->
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divide80"></div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="center-heading">
                <h2>VIDEO<strong></strong></h2>
                <span class="center-line"></span>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="cube-masonry">
        <div id="filters-container" class="cbp-l-filters-alignCenter">
        </div>
        <div id="masnory-container" class="cbp">

            @if(isset($vdos))
                @foreach($vdos as $vdo)
                    <div class="cbp-item company business">
                        <a class="cbp-caption cbp-lightbox"
                           href="{{ $vdo['url'] }}">
                            <div class="cbp-caption-defaultWrap">
                                <img src="{{ asset('c-profile') }}/img/record-thumbnail.jpg" alt="">
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
    </div><!--.cube masonry-->
</div>
<br>
<div class="divide70"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="center-heading">
                <h2>BRANCH <strong>ADDRESS</strong></h2>
                <span class="center-line"></span>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($branches as $branch)
            <div class="col-md-4 col-sm-6 margin20">
                <div class="services-box wow animated fadeIn" data-wow-duration="700ms" data-wow-delay="100ms">
                    <div class="services-box-icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div><!--services icon-->
                    <div class="services-box-info">
                        <h4>{{ $branch['name'] }}</h4>
                        <p>
                            <span><i class="fa fa-phone"
                                     aria-hidden="true"></i>&nbsp;{{ $branch['contact'] }}</span><br>
                            <span><i class="fa fa-envelope"
                                     aria-hidden="true"></i>&nbsp;{{ $branch['email'] }}</span><br>
                            {{--<span><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;www.addresshelp360.com</span><br>--}}
                            <span><i class="fa fa-map-marker"
                                     aria-hidden="true"></i>&nbsp;{{ $branch['address'] }}</span><br>
                        </p>
                    </div>
                </div><!--services box-->
            </div><!--services col-->
        @endforeach
    </div>
</div>
<br>
@if($businessHours)
    <section class="fun-fact-wrap fun-facts-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 margin20 facts-in">
                    <div class="opening">
                        <h2>OPENING HOURS</h2>
                    </div>
                </div>
                @foreach($businessHours as $bh=>$val)
                    <div class="col-md-1 margin20 facts-in">
                        <h4><b>{{ $days[$bh] }}</b></h4>
                        <span class="center-line1"></span>
                        @if($val["isActive"] === "true")
                            <h5><span class="dhon">{{ $val["timeFrom"]."-".$val["timeTill"] }}</span></h5>
                        @else
                            <h5><span class="text-danger">Close</span></h5>
                        @endif
                    </div><!--facts in-->
                @endforeach

                <div class="col-md-1 margin20 facts-in">
                </div>
            </div>
        </div>
    </section>
@endif
<div id="contact"><br>
    <div class="divide70"></div>
    <div class="assan-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="center-heading">
                        <h2>CONTACT <strong>US</strong></h2>
                        <span class="center-line"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 col-sm-6 margin20">
                        <div id="contact">
                            <div class="detail-content">
                                <div class="media-body">
                                    <div class="lt-co-icon"><img src="{{ asset('c-profile') }}/img/new-img/ic-loc.png"
                                                                 alt="ic-loc"></div>
                                    <div class="lt-co-blok-text">
                                        <div class="lt-co-title"><h4><b>Business Location</b></h4></div>
                                        <p class="">{{ posts_meta_collection_get($post->meta,'info','address') }}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="media-body">
                                <div class="lt-co-icon"><img src="{{ asset('c-profile') }}/img/new-img/ic-call.png"
                                                             alt="ic-call"></div>
                                <div class="lt-co-blok-text">

                                    <div class="lt-co-title"><h4><b>Phone | Email</b></h4></div>

                                    <p class="">
                                        @if(isset($contactmeta))
                                            <b>Phone/Mobile</b>
                                            :- @foreach ($contactmeta as $cont) {{ $cont['number'] }}, @endforeach<br>
                                        @endif
                                        <b>E-Mail</b> :- <a
                                                href="{{ posts_meta_collection_get($post->meta,'info','email') }}">{{ posts_meta_collection_get($post->meta,'info','email') }}</a><br>
                                        {{--<b>Website</b> :- <a href="www.bengaliict.com">www.bengaliict.com</a>--}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!--services box-->
                    <div class="col-md-6 col-sm-6 margin20">
                        <div style="height: 400px; width: 100%;" id="map"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<footer id="footer">
    <div class="container">
        <div class="row">
            <span>Copyright © 2017 Bengali ICT Ltd.</span>
        </div>
    </div>
</footer><!--default footer end here-->


<script>
    var lat = 0;
    var lng = 0;
    var myLatlng = {lat: 23.777176, lng: 90.399452};
    var savedLatLng = document.getElementById("geoLocation").value;
    if (savedLatLng) {
        var res = savedLatLng.split(",");
        lat = res[0];
        lng = res[1];
        myLatlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
    }

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: myLatlng
        });
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('app.gmap') }}&callback=initMap"
        type="text/javascript"></script>


<!--scripts and plugins -->
<!--must need plugin jquery-->
<script src="{{ asset('c-profile') }}/js/jquery.min.js"></script>
<script src="{{ asset('c-profile') }}/js/jquery-migrate.min.js"></script>

<!--bootstrap js plugin-->
<script src="{{ asset('c-profile') }}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--easing plugin for smooth scroll-->
<script src="{{ asset('c-profile') }}/js/jquery.easing.1.3.min.js" type="text/javascript"></script>
<!--sticky header-->
<script type="text/javascript" src="{{ asset('c-profile') }}/js/jquery.sticky.js"></script>
<!--flex slider plugin-->
<script src="{{ asset('c-profile') }}/js/jquery.flexslider-min.js" type="text/javascript"></script>
<!--parallax background plugin-->
<script src="{{ asset('c-profile') }}/js/jquery.stellar.min.js" type="text/javascript"></script>
<!--digit countdown plugin-->
<script src="{{ asset('c-profile') }}/js/waypoints.min.js"></script>
<!--digit countdown plugin-->
<script src="{{ asset('c-profile') }}/js/jquery.counterup.min.js" type="text/javascript"></script>
<!--on scroll animation-->
<script src="{{ asset('c-profile') }}/js/wow.min.js" type="text/javascript"></script>
<!--owl carousel slider-->
{{--<script src="{{ asset('c-profile') }}/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>--}}
<!--popup js-->
<script src="{{ asset('c-profile') }}/js/jquery.magnific-popup.min.js" type="text/javascript"></script>


<!--customizable plugin edit according to your needs-->

{{--<script type="text/javascript" src="{{ asset('c-profile') }}/rs-plugin/js/jquery.themepunch.tools.min.js"></script>--}}
{{--<script type="text/javascript" src="{{ asset('c-profile') }}/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>--}}
{{--<script type="text/javascript" src="{{ asset('c-profile/js/revolution-custom.js') }}"></script>--}}
<!--cube portfolio plugin-->
<script src="{{ asset('c-profile') }}/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
<script src="{{ asset('c-profile/js/cube-portfolio.js') }}" type="text/javascript"></script>
<script src="{{ asset('c-profile') }}/js/pace.min.js" type="text/javascript"></script>


{{--<script src="{{ asset('c-profile/js/custom.js') }}" type="text/javascript"></script>--}}
<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });


    });


    $(window).resize(function () {
        $(".navbar-collapse").css({maxHeight: $(window).height() - $(".navbar-header").height() + "px"});
    });
    //sticky header on scroll
    $(document).ready(function () {
        $(window).load(function () {
            $(".sticky").sticky({topSpacing: 0});
        });

        //on hover dropdown menu
        $(".navbar-nav>.dropdown").hover(function () {
            $(this).toggleClass("open");
        });
    });

    $(document).ready(function () {
        var wow = new WOW(
            {
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 100, // distance to the element when triggering the animation (default is 0)
                mobile: false        // trigger animations on mobile devices (true is default)
            }
        );
        wow.init();
    });
</script>
</body>
</html>
