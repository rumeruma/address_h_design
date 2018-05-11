@extends('layouts.page')

@section('content')

    <div id="breadcrum-inner-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="breadcrum-inner-header">
                        <h1>Subscribe to {{ $package->title }} plan</h1>
                        {{--<a href="{{ url('/#pricing-item-block') }}">Package</a> <i class="fa fa-circle"></i> <a--}}
                        {{--href="{{ url('/'.$package->name) }}"><span>{{ $package->title }}</span></a>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about-company">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12 v-center">
                    <div class="card">
                        <div class="card-body">{!! $package->excerpt !!}</div>
                    </div>
                    <p class="inner-secon-tl">
                    </p>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 v-center">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{{ route('single.package.store') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                                    <label for="businessName">Your Business Name</label>
                                    <input type="text" name="business_name" class="form-control"
                                           aria-describedby="namehMsg" id="businessName"
                                           value="" placeholder="eg: abcd enterprise">
                                    <small id="nameMsg" class="form-text text-muted text-danger">
                                        {!! $errors->has('business_name') ? '<i class="fa fa-warning"></i>' : '' !!}
                                        {{ $errors->first('business_name') }}
                                    </small>
                                    <input type="hidden" name="packageid" value="{{ encrypt($package->id) }}">
                                </div>
                                <div class="form-group{{ $errors->has('business_type') ? ' has-error' : '' }}">
                                    <label for="businessType">Your Business Type</label>
                                    <input type="text" name="business_type" class="form-control"
                                           aria-describedby="bkashMsg" id="businessType"
                                           value="" placeholder="eg: General store/Real estate">
                                    <small id="typeMsg" class="form-text text-muted text-danger">
                                        {!! $errors->has('business_type') ? '<i class="fa fa-warning"></i>' : '' !!}
                                        {{ $errors->first('business_type') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="packageName">Package Name</label>
                                    <input type="text" class="form-control" id="packageName"
                                           value="{{ $package->title }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="packagePrice">Subscription Per Year</label>
                                    <input type="text" class="form-control" id="packagePrice"
                                           value="{{ $package->meta['package_price'][0] }}" readonly>
                                </div>
                                <div class="form-group {{ $errors->has('bkash_token') ? ' has-error' : '' }}">
                                    <label for="bkashToken">Bkash Payment Token</label>
                                    <input type="text" name="bkash_token" class="form-control"
                                           aria-describedby="bkashMsg" id="bkashToken" value="">
                                    <small id="bkashMsg" class="form-text text-muted text-danger">
                                        {!! $errors->has('bkash_token') ? '<i class="fa fa-warning"></i>' : '' !!}
                                        {{ $errors->first('bkash_token') }}
                                    </small>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>


                                {{--@if ($errors->any())--}}
                                {{--<div class="alert alert-danger">--}}
                                {{--<div class="card">--}}
                                {{--<div class="card-body">--}}
                                {{--<ul class="nav flex-column">--}}
                                {{--@foreach ($errors->all() as $error)--}}
                                {{--<li><i class="fa fa-warning"></i> {!! $error !!} </li>--}}
                                {{--@endforeach--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endif--}}

                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </form>


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