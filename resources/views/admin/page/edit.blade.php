@extends('admin.page.new')

@section('title', 'Edit Page')
@section('edtID', '/'.$page->id)
@section('edtTitle', $page->title)
@section('edtContent', $page->content)
@section('edtExcerpt', $page->excerpt)
@section('edtFimg', \App\Http\Helpers\Poster::featuredImageSrc($meta))
@section('editMethod')

    {{ method_field('PUT') }}

@endsection

@section('edit-scripts')

    <script>
        $(document).ready(function(){
            $("#holder").attr("src", "{{ \App\Http\Helpers\Poster::featuredImageSrc($meta) }}");

            if($("#holder").attr("src")){
                $("#killFeature").show();
            } else {
                $("#killFeature").hide();
            }

            $("#killFeature").on('click', function(){
                $("#holder").removeAttr("src");
                $("#thumbnail").val("");

            });
        });
    </script>

@endsection