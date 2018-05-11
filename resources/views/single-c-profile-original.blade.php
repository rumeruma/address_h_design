@extends('layouts.page')

@section('content')

    <div class="details-lt-block">
        <div class="slt_block_bg"><img src="images/detail-view-bg.jpg" alt=""></div>
        <div class="container header_slt_block">
            <div class="slt_item_head">
                <div class="user_logo_pic"><img alt="" src="{{ posts_featured_image_uri($post->meta, 'logo') }}"></div>
                <div class="slt_item_contant">
                    <h1>{{ $post->title }}</h1>
                    <p class="location"><i class="fa fa-map-marker"></i> {{ posts_meta_collection_get($post->meta,'info','address') }}
                    </p>
                    <div class="rating-box">
                        <div class="rating"><span> {{ posts_meta_collection_get($post->meta,'info','tagline') }} </span>
                        </div>
                    </div>
                    @php
                        $links = posts_meta(get_metaext($post->meta), 'links');
                    @endphp
                    <div class="head-bookmark-bock">
                        <ul class="social-icons">
                            @foreach($links as $link)
                                <li><a target="_blank" href="{{ $link['url'] }}"><i
                                                class="fa fa-{{ $link['type'] }}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="vfx-product-inner-item">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    @php
                        $sliders = posts_meta(get_metaext($post->meta), 'slider');
                    @endphp
                    <div class="detail-content">
                    @if(isset($sliders))
                        <div class="slider">
                            <div id="preview">
                                <div id="preview-coverflow">
                                    @foreach($sliders as $slider)
                                        <img class="cover re" src="{{ $slider }}" alt="Los Angeles">
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif
                    </div>

                    <div class="dlt-title-item">
                        {!! $post->content !!}
                    </div>
                    <div class="clearfix"></div>

                    <div class="detail-content">
                        @php
                            $vdos = posts_meta(get_metaext($post->meta), 'vdo');
                        @endphp

                        @if(isset($vdos))
                            <h2>Business Video</h2>
                            <div class="fucking-video">
                                <div style="min-height: 300px; height: auto;" class="owl-carousel owl-theme">
                                    @foreach($vdos as $vdo)
                                        <div class="item-video"><a class="owl-video" href="{{ $vdo['url'] }}"></a></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <hr>
                    </div>
                    <div>
                        @php
                            $branches = posts_meta(get_metaext($post->meta), 'branches');
                        @endphp
                        <div class="detail-content">
                            <div class="media-body">
                                <div class="branch">
                                    <h3><b><u>Branch Address</u></b></h3></div>
                                @foreach($branches as $branch)
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <address>
                                            <strong class="text-info"><u>{{ $branch['name'] }}</u></strong><br>
                                            <i class="fa fa-map-marker"></i> {{ $branch['address'] }}<br>
                                            <i class="fa fa-envelope"></i> {{ $branch['email'] }}<br>
                                            <i class="fa fa-phone"></i> {{ $branch['contact'] }}<br>
                                        </address>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="sidebar-listing-search-wrap">
                        <img src="images/demo/a1.gif">
                    </div>
                    <br>
                    <div class="left-slide-slt-block">
                        <h3>Related Company</h3>
                    </div>
                    <div class="left-location-item">
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Manchester</a><span
                                        class="list-lt">07</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Lankashire</a><span
                                        class="list-lt">04</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> New Mexico</a><span
                                        class="list-lt">03</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Nevada</a><span
                                        class="list-lt">06</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> Kansas</a><span
                                        class="list-lt">08</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> West Virginina</a><span
                                        class="list-lt">05</span></li>
                        </ul>
                    </div>
                    <div class="left-slide-slt-block">
                        <h3>Archives</h3>
                    </div>
                    <div class="left-archive-categor">
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> January 2016</a><span
                                        class="list-lt">09</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> February 2016</a><span
                                        class="list-lt">52</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> March 2016</a><span
                                        class="list-lt">36</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> April 2016</a><span
                                        class="list-lt">78</span></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> May 2016</a><span class="list-lt">66</span>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i> June 2016</a><span class="list-lt">15</span>
                            </li>
                        </ul>
                    </div>
                    <div class="left-slide-slt-block">
                        <h3>Opening Hours</h3>
                    </div>
                    <div class="working-hours">
                        <div class="days"><span class="name">Monday</span><span class="hours">10:00 am ~ 06:00 pm</span>
                        </div>
                        <div class="days"><span class="name">Tuesdat</span><span
                                    class="hours">10:00 am ~ 06:00 pm</span></div>
                        <div class="days"><span class="name">Wednesday</span><span
                                    class="hours">10:00 am ~ 06:00 pm</span></div>
                        <div class="days"><span class="name">Thursday</span><span
                                    class="hours">10:00 am ~ 06:00 pm</span></div>
                        <div class="days"><span class="name">Friday</span><span class="hours">10:00 am ~ 06:00 pm</span>
                        </div>
                        <div class="days"><span class="name">Saturday</span><span
                                    class="hours">10:00 am ~ 06:00 pm</span></div>
                        <div class="days"><span class="name">Sunday</span><span class="hours">Closed</span></div>
                    </div>
                    <div class="sidebar-listing-search-wrap">
                        <img src="images/demo/a1.gif">
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection
{{--@include('template-parts/authpop')--}}
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.coverflow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.interpolate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.touchSwipe.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/reflection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            if ($.fn.reflect) {
                $('#preview-coverflow .cover').reflect();	// only possible in very specific situations
            }

            $('#preview-coverflow').coverflow({
                index: 3,
                density: 1,
                innerOffset: 40,
                innerScale: .6,
                animateStep: function (event, cover, offset, isVisible, isMiddle, sin, cos) {
                    if (isVisible) {
                        if (isMiddle) {
                            $(cover).css({
                                'filter': 'none',
                                '-webkit-filter': 'none'
                            });
                        } else {
                            var brightness = 1 + Math.abs(sin),
                                contrast = 1 - Math.abs(sin),
                                filter = 'contrast(' + contrast + ') brightness(' + brightness + ')';
                            $(cover).css({
                                'filter': filter,
                                '-webkit-filter': filter
                            });
                        }
                    }
                }
            });

            $('.owl-carousel').owlCarousel({
                items: 1,
                merge: true,
                loop: true,
                margin: 10,
                video: true,
                lazyLoad: true,
                center: true,
                responsive: {
                    480: {
                        items: 1
                    },
                    600: {
                        items: 1
                    }
                }
            });

        });
    </script>


@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('js/owl.carousel/dist/assets/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('js/owl.carousel/dist/assets/owl.theme.default.css') }}" type="text/css">
    <style>


        #preview {
            padding-top: 5rem;
            /*padding-bottom: 5rem;*/
        }

        #preview-coverflow .cover {
            cursor: pointer;
            width: 320px;
            height: auto;
            -webkit-box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            -moz-box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            border-radius: 5px;
        }

        .owl-carousel {
            /*margin: 2rem 0*/
        }

        .owl-carousel .item {
            height: 10rem;
            background: #4DC7A0;
            padding: 1rem
        }

        .owl-carousel .item h4 {
            color: #FFF;
            font-weight: 400;
            margin-top: 0rem
        }

        .owl-carousel .item-video {
            height: 300px
        }

        #setup {
            margin-top: 4rem
        }

        .demo-list h5 {
            margin: 0
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
             height: auto !important;
        }

        .slt_block_bg{
            background-image: url({{ posts_featured_image_uri($post->meta, 'image') }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }


    </style>

@endsection
