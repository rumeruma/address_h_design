@extends('layouts.page')

@section('content')
    <div id="vfx-product-inner-item">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('search-form')
                </div>
            </div>
            <div class="row">
                @if($posts->count())
                    @foreach($posts as $post)

                        @php
                            $contactmeta = posts_meta(get_metaext($post->meta), 'contacts');
                            $contact = "not available";
                            if(isset($contactmeta)){
                                foreach ($contactmeta as $cont){
                                        if($cont['type'] == 'office'){ $contact = $cont['number']; }
                                }
                            }

                            $image = posts_meta(get_metaext($post->meta), 'posts_featured_image');
                            $logo = posts_thumbnail_uri(posts_meta_collection($image,'logo'));

                        @endphp
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ route('home.post',[$post->name]) }}">
                                        <img class="img-responsive img-thumbnail" src="{{ $logo }}">
                                    </a>
                                </div>
                                <div class="col-md-10">
                                    <a class="search-link" href="{{ route('home.post',[$post->name]) }}">
                                        <h4>{{ $post->title }}</h4>
                                    </a>
                                    <p>{{ (cut_limit($post->excerpt, 40)) ? cut_limit($post->excerpt, 40) : "There are many variations of passages of Lorem Ipsum available, but the majority" }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                    <div class="vfx-person-block">
                        {{ $posts->links('vendor.pagination.360-pager') }}
                    </div>
                @else
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4>Sorry ... Result not found</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        a.search-link * {
            color: rgb(37, 144, 213);
            text-decoration: underline;
            margin-top: 1rem;
            font-weight: 100;
        }

        a.search-link:visited * {
            color: rgb(130, 100, 245);
        }
    </style>
@endsection