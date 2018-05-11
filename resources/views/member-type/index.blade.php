@extends('layouts.page')

@section('content')
    <div id="vfx-product-inner-item">
        <div class="container">
            <div class="row">

                {{--3start--}}
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="left-slide-slt-block">
                        <h3>{{ $packagename['title'] }} <span>Members</span></h3>
                    </div>

                        <div class="list-group">
                            <a href="#" class="list-group-item active">Member Types</a>
                                @foreach($featuredpackages as $featpkg)
                                    <a id="{{ $featpkg->name }}" href="{{ route('show.member.type', [$featpkg->name]) }}" class="list-group-item">
                                        <i class="fa fa-hand-o-right"></i> {{ $featpkg->title }}
                                        <span class="list-lt">{{ count($featpkg->active_subscription) }}</span>
                                    </a>
                                @endforeach

                        </div>



                    <img src="{{ asset('images/demo/a1.gif') }}">
                </div>
                {{--3 end--}}

                <div class="col-md-9 col-sm-8 col-xs-12">
                    @include('search-form')

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @foreach($subscriptions->chunk(3) as $subscription)
                                <div class="row">
                                    @foreach($subscription as $subs)

                                        @php
                                            $contactmeta = posts_meta(get_metaext($subs->post->meta), 'contacts');
                                            $contact = "not available";
                                            if(isset($contactmeta)){
                                                foreach ($contactmeta as $cont){
                                                        if($cont['type'] == 'office'){ $contact = $cont['number']; }
                                                }
                                            }
                                            $image = posts_meta(get_metaext($subs->post->meta), 'posts_featured_image');
                                            $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));//posts_meta_collection($image,'image')
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
                                                        <a href="{{ route('home.post',[$subs->post->name]) }}">{{ $subs->post->title }}</a>
                                                    </h3>
                                                    <a href="#"><i class="fa fa-phone"></i>{{ $contact }}</a>
                                                    <p>{{ (cut_limit($subs->post->excerpt, 12)) ? cut_limit($subs->post->excerpt, 12) : "There are many variations of passages of Lorem Ipsum available, but the majority" }}</p>
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

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="vfx-person-block">
                            {{ $subscriptions->links('vendor.pagination.360-pager') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection