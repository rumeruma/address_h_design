@extends('layouts.page')

@section('content')

    <div id="breadcrum-inner-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="breadcrum-inner-header">
                        <h1>{{ $package->title }}</h1>
                        <a href="{{ url('/#pricing-item-block') }}">Package</a> <i class="fa fa-circle"></i> <a
                                href="{{ url('/'.$package->name) }}"><span>{{ $package->title }}</span></a></div>
                </div>
            </div>
        </div>
    </div>

    <div id="about-company">
        <div class="container">
            <div class="row">

                <div class="col-md-9 col-sm-12 col-xs-12 v-center">
                    <div class="card">
                        <div class="card-body">{!! $package->content !!}</div>
                    </div>
                    <p class="inner-secon-tl">
                    </p>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 v-center">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Slider Limit :</b>{{ $package->meta['package_media']['slider_image'] }} Images</p>
                            <p><b>Video Limit :</b>{{ $package->meta['package_media']['vdo'] }} Urls</p>
                            <p><b>Subscription :</b> BDT {{ $package->meta['package_price'][0] }}/= per Year</p>
                            <p><a class="btn btn-success" href="{{ route('single.package.create', ['slug' => $package->name]) }}"><i class="fa fa-cart-plus"></i> Subscribe This Package</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br/>
        <br/>
    </div>

@endsection
{{--@include('template-parts/authpop')--}}