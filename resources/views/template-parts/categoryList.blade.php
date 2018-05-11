<div id="feature-item_listing_block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="row">
                    <div class="col-md-12 all-categorie-list-title bt_heading_3">
                        <h1>All Business <span>Categorie</span></h1>
                        <div class="blind line_1"></div>
                        <div class="flipInX-1 blind icon"><span class="icon"><i class="fa fa-stop"></i>&nbsp;&nbsp;<i
                                        class="fa fa-stop"></i></span></div>
                        <div class="blind line_2"></div>
                    </div>
                </div>

                <div class="row">

                    @foreach($basecategories->chunk(4) as $businesscategory)
                        <div class="row">
                            @foreach ($businesscategory as $category)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="categorie-list-box">
                                    <div class="search-categories-boxes">
                                        <h2><a href="{{ route('show.buscat', [$category->name]) }}" style="color:white;"><i class="fa fa-suitcase"></i> {{ $category->title }} </a></h2>
                                    </div>
                                    <div class="categories-list">
                                        <ul>
                                            @if(count($category->featured_childs))
                                                @foreach($category->featured_childs as $child)

                                                    <li>
                                                        <a href="{{ route('show.buscat', [$child->name]) }}" >
                                                            <i class="fa fa-hand-o-right"></i>
                                                            {{ $child->title }}
                                                        </a>
                                                        <span>{{ count($child->posts) }}</span>
                                                    </li>

                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    @endforeach


                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <a href="{{ route('show.buscat') }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                    <br>
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
    </div>
</div>