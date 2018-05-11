<footer class="site-footer footer-map">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h2>About Us</h2>
                    <hr>
                    <p class="about-lt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer justo lectus,
                        consectetur quis nisi vitae, Nunc eget ultrices ligula.</p>
                    <a href="about.html" class="btn-primary-link more-detail"><i class="fa fa-hand-o-right"></i> Read
                        More</a>
                    <h2>Follow Us</h2>
                    <hr>
                    <ul class="social-icons">
                        @foreach(get_site_option('social-links') as $sl)
                            <li><a target="_blank" href="{{ $sl['url'] }}"><i class="fa fa-{{ $sl['type'] }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h2>Recent Listing</h2>
                    <hr>
                    <ul class="widget-news-simple">
                        @foreach(get_some_motherfucking_post(2) as $post)

                            @php
                                $image = posts_meta(get_metaext($post->meta), 'posts_featured_image');
                                $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));//posts_meta_collection($image,'image')
                            @endphp
                            <li>
                                <div class="news-thum"><a href="{{ route('home.post',[$post->name]) }}"><img src="{{ $logo }}" alt="logo"></a></div>
                                <div class="news-text-thum">
                                    <h6><a href="{{ route('home.post',[$post->name]) }}">{{ $post->title }}</a></h6>
                                    <p>{{ (cut_limit($post->excerpt, 7)) ? cut_limit($post->excerpt, 7) : "Eiusmod tempor incidiunt labore velit dolore ..." }}</p>
                                    {{--<div>Price: $117</div>--}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h2>Useful links</h2>
                    <hr>
                    <ul class="use-slt-link">
                        @if($themenu)
                            @foreach($themenu['content'] as $menu)

                                <li><a href="{{ check_url($menu['href']) }}"><i class="fa fa-hand-o-right"></i>
                                        &nbsp;{{ $menu['text'] }}</a></li>
                            @endforeach
                        @else
                            <li>Add Menu Item</li>
                        @endif


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h2>Have you any Query?</h2>
                    <hr>

                    <div style="display: none;" id="contact-form-success" class="alert alert-success">

                    </div>

                    <div id="contact-form-common" class="form-alt">
                        <div class="form-group">
                            <input id="contact-nmae" nmae="c_name" type="text" placeholder="Name :-" required
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <input id="contact-email" name="c_email" type="email" placeholder="Email :-" required
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea id="contact-message" name="c_message" placeholder="Message :-" required
                                      class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button id="submitContact" type="button" class="btn-quote">Send Now</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <p class="text-xs-center">Copyright © 2017 All Rights Reserved.</p>
                </div>
                <div><a href="#" class="scrollup">Scroll</a></div>
            </div>
        </div>
    </div>
</footer>

