@include('admin.template-parts.header')

<div>
	@include('admin.template-parts.navmain')

	<div class="wrapper">
	    <div id="app" class="columns">

		    <aside class="column is-2 aside">
		    	@include('admin.template-parts.sidenav')
		    </aside>

	    	<main class="column main">
	    		 @yield('content')
	    	</main>
	    	 
	    </div>
	</div>
	
</div>

 @include('admin.template-parts.footer')