<div id="feature-item_listing_block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="col-md-12 feature-item-listing-heading bt_heading_3">
                    <h1>{{ $packagename['title'] }}<span>Members</span></h1>
                    <div class="blind line_1"></div>
                    <div class="flipInX-1 blind icon"><span class="icon"><i class="fa fa-stop"></i>&nbsp;&nbsp;<i
                                class="fa fa-stop"></i></span></div>
                    <div class="blind line_2"></div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        @foreach($subscriptions->chunk(4) as $subscibe)
                        <div class="row">
                            @foreach($subscibe as $subs)

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
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="feature-item-container-box listing-item">
                                    <div class="feature-title-item">
                                        <img src="{{ $logo }}" alt="img5">
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="hover-overlay-inner">
                                            <ul class="listing-links">
                                                <li><a href="#"><i class="fa fa-heart green-1 "></i></a></li>
                                                <li><a href="#"><i class="fa fa-map-marker blue-1"></i></a></li>
                                                <li><a href="#"><i class="fa fa-share yallow-1"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="min-height: 15rem; max-height: 15rem;"
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

                    <div class="col-md-12">
                        <a href="{{ route('show.member.type',[$packagename['name']]) }}" class="btn btn-primary">View
                            More</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div>
                    <img src="{{ asset('images/demo/add1.gif') }}" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>