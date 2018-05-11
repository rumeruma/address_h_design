@include('admin.template-parts.header')

<div>
    @include('admin.template-parts.navmain')

    <div class="wrapper">
        <div id="app" class="columns">


            <main class="column main">
                <h1 class="h1 text-center text-danger">Oops! Something Went Wrong...</h1>
                <p class="lead text-center">You Can Go <a href="javascript:" onclick="window.history.back();" > Back</a> Where You Was ...</p>
            </main>

        </div>
    </div>

</div>

@include('admin.template-parts.footer')