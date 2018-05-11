@php
    $subscriptions = array();
    $packagename = package_by_name('platinum');
        if($packagename){
        $subscriptions = $packagename->memberAsRequired(4);
        }
@endphp

<div class="fullwidthbanner">
    <div class="tp-banner">
        <ul>

        @foreach($subscriptions as $subs)

            @php
                $contactmeta = posts_meta(get_metaext($subs->post->meta), 'contacts');
                $contact = "not available";
                if(isset($contactmeta)){
                    foreach ($contactmeta as $cont){
                            if($cont['type'] == 'office'){ $contact = $cont['number']; }
                    }
                }
                $image = posts_meta(get_metaext($subs->post->meta), 'posts_featured_image');
                $image_cover = posts_featured_image_uri($subs->post->meta, 'image');
                $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));//posts_meta_collection($image,'image')
            @endphp
            <!-- SLIDE -->
                <li data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="ADDRESSHELP360.COM">
                    <!-- MAIN IMAGE -->
                    <img src="{{ $image_cover }}" alt="darkblurbg" data-bgfit="cover"
                         data-bgposition="left top" data-bgrepeat="no-repeat">
                    <div class="caption text-right-top sft"
                         data-x="right"
                         data-y="20"
                         data-speed="1000"
                         data-start="1400"
                         data-easing="easeOutExpo">
                        PLATINUM MEMBER
                    </div>
                    <div class="caption title-2 sft"
                         data-speed="1000"
                         data-start="1000"
                         data-easing="easeOutExpo">
                        <a href="{{ route('home.post',[$subs->post->name]) }}"><img src="{{ $logo }}" height="200px" width="200px"
                                         id="slidelogo"></a><br><br><br>
                    </div>
                    <div class="caption title-3 sfl"
                         data-speed="1000"
                         data-start="1000"
                         data-easing="easeOutExpo">
                        <a href="{{ route('home.post',[$subs->post->name]) }}">{{ $subs->post->title }}</a> <br>

                    </div>
                    <div class="caption text sfl"
                         data-speed="1000"
                         data-start="1800"
                         data-easing="easeOutExpo">
                        <a href="{{ route('home.post',[$subs->post->name]) }}"><i class="fa fa-map-marker"></i> {{ posts_meta_collection_get($subs->post->meta,'info','address') }}</a>
                    </div>
                    <div class="caption textt sfl"
                         data-speed="1000"
                         data-start="1800"
                         data-easing="easeOutExpo">
                        <a href="{{ route('home.post',[$subs->post->name]) }}">"{{ posts_meta_collection_get($subs->post->meta,'info','tagline') }}"</a>
                    </div>

                </li>
            @endforeach



        </ul>
    </div>
</div>