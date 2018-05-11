@extends('layouts.page')

@section('content')
    <div id="vfx-product-inner-item">
        <div class="container">
            <div class="row">

                {{--3start--}}
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="left-slide-slt-block">
                        <h3>Categories</h3>
                    </div>

                    @foreach($basecategories as $category)
                        <div class="list-group">
                            <a id="{{ $category->name }}" href="{{ route('show.buscat', [$category->name]) }}"
                               class="list-group-item active">{{ $category->title }}</a>
                            @if(count($category->childs))
                                {{--@include('business-profile.dumpChild',['childs' => $category->childs])--}}
                                @foreach($category->childs as $child)
                                    <a id="{{ $child->name }}" href="{{ route('show.buscat', [$child->name]) }}"
                                       class="list-group-item">
                                        <i class="fa fa-hand-o-right"></i> {{ $child->title }}
                                        <span class="list-lt">{{ count($child->posts) }}</span>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    @endforeach


                    <img src="{{ asset('images/demo/a1.gif') }}">
                </div>
                {{--3 end--}}

                <div class="col-md-9 col-sm-8 col-xs-12">
                    @include('search-form')
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($posts->chunk(3) as $post)
                                <div class="row">
                                    @foreach($post as $pot)

                                        @php
                                            $contactmeta = posts_meta(get_metaext($pot->meta), 'contacts');
                                            $contact = "not available";
                                            if(isset($contactmeta)){
                                                foreach ($contactmeta as $cont){
                                                        if($cont['type'] == 'office'){ $contact = $cont['number']; }
                                                }
                                            }

                                            $image = posts_meta(get_metaext($pot->meta), 'posts_featured_image');
                                            $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));

                                        @endphp

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="feature-item-container-box listing-item">
                                                <div class="feature-title-item">
                                                    <img src="{{ $logo }}" alt="img5"></div>
                                                <div class="hover-overlay">
                                                    <div class="hover-overlay-inner">
                                                        <ul class="listing-links">
                                                            <li><a href="#"><i class="fa fa-heart green-1 "></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="fa fa-map-marker blue-1"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="fa fa-share yallow-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div style="min-height: 15rem; max-height: 15.1rem;"
                                                     class="feature-box-text">
                                                    <h3>
                                                        <a href="{{ route('home.post',[$pot->name]) }}">{{ $pot->title }}</a>
                                                    </h3>
                                                    <a href="#"><i class="fa fa-phone"></i>{{ $contact }}</a>
                                                    <p>{{ (cut_limit($pot->excerpt, 12)) ? cut_limit($pot->excerpt, 12) : "There are many variations of passages of Lorem Ipsum available, but the majority" }}</p>
                                                </div>
                                                <div class="feature-item-location">
                                                    <h2><i class="fa fa-map-marker"></i> Your City Here</h2>
                                                    <span> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star-o"></i> </span>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        @if(count($posts) == 0)
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1>Sorry No Profile Found In Your Selected Category!!</h1>
                            </div>
                        @endif
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="vfx-person-block">
                            {{ $posts->links('vendor.pagination.360-pager') }}
                            {{--<ul class="vfx-pagination">--}}
                                {{--<li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>--}}
                                {{--<li class="active"><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>--}}
                            {{--</ul>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#{{ $slug }}').addClass('selected-cat')

        });
    </script>
@endsection

@section('style')
    <style>
        .selected-cat {
            background: transparent linear-gradient(to right, #ff0000 50%, #f5f5f5 50%) repeat scroll right bottom / 207% 100%;
            color: #ffffff !important;
            text-decoration: none;
            background-position: left bottom;
            border-color: #ddd !important;
        }
    </style>
@endsection