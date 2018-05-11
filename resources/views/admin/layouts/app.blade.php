@include('admin.template-parts.header')
    <div id="app">
        @include('admin.template-parts.navmain')
        @yield('content')
    </div>
@include('admin.template-parts.footer')