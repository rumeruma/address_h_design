<nav class="menu">


    <div class="collapse width show" id="sidebar">

        <div class="list-group border-0 card text-center text-md-left">

            <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
                <i class="fa fa-dashboard"></i>
                <span class="d-none d-md-inline">Dashboard</span>
            </a>
            @if(Auth::user()->role[0]->name == 'admin')
                <a href="#menu3" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-file-powerpoint-o"></i>
                    <span class="d-none d-md-inline">Page</span>
                </a>
                <div class="collapse" id="menu3">
                    <a href="{{ route('page.index') }}" class="list-group-item" data-parent="#menu3">All Pages</a>
                    <a href="{{ route('page.create') }}" class="list-group-item" data-parent="#menu3">Add New Page</a>
                </div>

                <a href="#menu4" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-file-archive-o "></i>
                    <span class="d-none d-md-inline">Package </span>
                </a>
                <div class="collapse" id="menu4">
                    <a href="{{ route('package.index') }}" class="list-group-item" data-parent="#menu3">All Packages</a>
                    <a href="{{ route('package.create') }}" class="list-group-item" data-parent="#menu3">Add New
                        Package</a>
                </div>


                <a href="#menu5" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-file-powerpoint-o"></i>
                    <span class="d-none d-md-inline">Subscriptions</span>
                </a>
                <div class="collapse" id="menu5">
                    <a href="{{ route('subscription.inactive') }}" class="list-group-item" data-parent="#menu3">Subscriptions
                        Pending</a>
                    <a href="{{ route('subscription.active') }}" class="list-group-item" data-parent="#menu3">Subscriptions
                        Active</a>
                </div>
            @endif

            <a href="{{ route('menu.manager') }}" class="list-group-item d-inline-block collapsed"
               data-parent="#sidebar">
                <i class="fa fa-stop-circle"></i>
                <span class="d-none d-md-inline">Menu</span>
            </a>

            <a href="{{ route('business.category') }}" class="list-group-item d-inline-block collapsed"
               data-parent="#sidebar">
                <i class="fa fa-stop-circle"></i>
                <span class="d-none d-md-inline">Business Categories</span>
            </a>
            @if(Auth::user()->role[0]->name == 'admin')
                <a href="{{ route('user.index') }}" class="list-group-item d-inline-block collapsed"
                   data-parent="#sidebar">
                    <i class="fa fa-users"></i>
                    <span class="d-none d-md-inline">Users</span>
                </a>

                <a href="#menu6" class="list-group-item d-inline-block collapsed" data-toggle="collapse"
                   data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-gears"></i>
                    <span class="d-none d-md-inline">Options</span>
                </a>
                <div class="collapse" id="menu6">
                    <a href="{{ route('manege.option',['social-links']) }}" class="list-group-item" data-parent="#menu6">Social Links</a>

                </div>
            @endif

        </div>
    </div>

</nav>

{{--https://www.codeply.com/go/8ESO56VMns/bootstrap-4-sidebar-menu-(toggleable)--}}