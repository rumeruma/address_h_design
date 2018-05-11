@extends('layouts.page')

@section('content')
<div class="container">
    <div class="row">
        <div id="user" class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($errors))
                    @foreach($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span>
                    @endforeach
                    @endif

                    <upload-form :user="{{ $profile }}"></upload-form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- <form action="{{ route('my-profile.avatar') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="file" name="media">
                        <input type="submit" value="submit">
                    </form> -->