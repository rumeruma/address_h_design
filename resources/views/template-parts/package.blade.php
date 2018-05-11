<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="col-md-12 pricing-heading-title bt_heading_3">
                <h1>Package <span>Plan</span></h1>
                <div class="blind line_1"></div>
                <div class="flipInX-1 blind icon"><span class="icon"><i class="fa fa-stop"></i>&nbsp;&nbsp;<i
                                class="fa fa-stop"></i></span></div>
                <div class="blind line_2"></div>
            </div>
            <div class="row">

                @foreach($thepackages as $package)
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="price-table-feature-block">
                            <h1>{{ $package->title }}</h1>
                            <hr>
                            <p>TK <span>{{ $package->meta['package_price'][0] }}</span> Per Year</p>

                            {!! $package->excerpt !!}
                            {{--<div class="vfx-pl-seperator"><span><i class="fa fa-caret-down"></i></span></div>--}}
                            {{--<div class="vfx-price-list-item">--}}
                                {{--<h2>Limited Number</h2>--}}
                                {{--<p>Our company offers best pricing options for field agents and companies.</p>--}}
                            {{--</div>--}}
                            {{--<div class="vfx-price-list-item">--}}
                                {{--<h2>One Agent for All</h2>--}}
                                {{--<p>Our company offers best pricing options for field agents and companies.</p>--}}
                            {{--</div>--}}
                            {{--<div class="vfx-price-list-item">--}}
                                {{--<h2>Mail Communication</h2>--}}
                                {{--<p>Our company offers best pricing options for field agents and companies.</p>--}}
                            {{--</div>--}}
                            <div class="vfx-price-btn">
                                <a href="{{ route('single.package', ['slug' => $package->name]) }}" class="btn btn-default"><i class="fa fa-cart-plus"></i> Detail</a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <br><br/>
</div>
