@extends('admin.package.new')
@section('title', 'Edit Package')
@section('edtID', '/'.$package->id)
@section('edtTitle', $package->title)
@section('edtContent', $package->content)
@section('edtExcerpt', $package->excerpt)
@section('edtPrice', $meta['package_price'][0])
@section('edtSlider', $meta['package_media']['slider_image'])
@section('edtVideo', $meta['package_media']['vdo'])
@section('editMethod')

    {{ method_field('PUT') }}

@endsection

@section('edit-scripts')

    <script>
        $(document).ready(function(){

        });
    </script>

@endsection