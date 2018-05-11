<div class="sorts-by-results">
    <form method="GET" action="{{ route('search') }}">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <div class="news-search-lt">
                <input class="form-control" placeholder="Search" type="text" name="search" value="{{ old('search') }}">
                <span class="input-search"> <i class="fa fa-search"></i> </span></div>
            <button style="display: none;" class="btn btn-success">Search</button>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <div class="disp-f-right">
                {{--<div class="disp-style active"><a href="listing_grid.html"><i class="fa fa-th"></i></a></div>--}}
            </div>
        </div>
    </form>
</div>