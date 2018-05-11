<div id="recent-product-item-listing">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="col-md-12 recent-item-listing-heading bt_heading_3">
                    <h1>Recent <span>Members</span></h1>
                    <div class="blind line_1"></div>
                    <div class="flipInX-1 blind icon"><span class="icon"><i class="fa fa-stop"></i>&nbsp;&nbsp;<i class="fa fa-stop"></i></span></div>
                    <div class="blind line_2"></div>
                </div>
                <div class="row">
                    @foreach($recentposts as $post)

                        @php
                            $contactmeta = posts_meta(get_metaext($post->meta), 'contacts');
                            $contact = "not available";
                            if(isset($contactmeta)){
                                foreach ($contactmeta as $cont){
                                        if($cont['type'] == 'office'){ $contact = $cont['number']; }
                                }
                            }
                            $image = posts_meta(get_metaext($post->meta), 'posts_featured_image');
                            $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));//posts_meta_collection($image,'image')
                        @endphp
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="recent-listing-box-container-item">
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="recent-listing-box-image">
                                    {{--<h1></h1>--}}
                                    <img src="{{ $logo }}" alt="img1"> </div>
                                <div class="hover-overlay">
                                    <div class="hover-overlay-inner">
                                        <ul class="listing-links">
                                            <li><a href="#"><i class="fa fa-heart green-1"></i></a></li>
                                            <li><a href="#"><i class="fa fa-map-marker blue-1"></i></a></li>
                                            <li><a href="#"><i class="fa fa-share yallow-1"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="recent-listing-box-item">
                                    <div class="listing-boxes-text"> <a href="{{ route('home.post',[$post->name]) }}">
                                            <h3>{{ $post->title }}</h3>
                                        </a> <a href="#"><i class="fa fa-phone"></i> {{ $contact }} </a>
                                        <p>{{ (cut_limit($post->excerpt, 17)) ? cut_limit($post->excerpt, 17) : "Eiusmod tempor incidiunt labore velit dolore magna aliqu sed veniam quis nostrud lorem ipsum dolor sit amet consectetur..." }}</p>
                                    </div>
                                    <div class="recent-feature-item-rating">
                                        <h2><i class="fa fa-map-marker"></i> Your City Here</h2>
                                        <span> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{--<button type="button" class="btn btn-primary">View More</button>--}}
                </div>
                <br>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <img src="{{ asset('images/demo/a2.gif') }}" width="100%">
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <img src="{{ asset('images/demo/a2.gif') }}" width="100%">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>