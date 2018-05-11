@extends('admin.post.new')

@section('title', 'Edit Page')
@section('edtID', '/'.$post->id)
@section('edtTitle', $post->title)
@section('edtContent', $post->content)
@section('edtExcerpt', $post->excerpt)
@section('edtFimg', \App\Http\Helpers\Poster::featuredImageSrc($meta))
@section('editMethod')

    {{ method_field('PUT') }}

@endsection

@section('edit-scripts')

    <script>
        $(document).ready(function(){
            $("#holder").attr("src", "{{ \App\Http\Helpers\Poster::featuredImageSrc($meta) }}");
        });
    </script>

@endsection