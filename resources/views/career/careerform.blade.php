@extends('layouts.page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2><b>
                            <center>SEND YOUR CV</center>
                        </b></h2>
                    <hr>

                    <form enctype="multipart/form-data" method="POST" action="{{ route('360.career.apply') }}">
                        @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Your Name :</label>
                            <input type="text" name="sender_name" class="form-control" id="exampleInputEmail1"
                                   placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label>Your Email : </label>
                            <input type="email" name="sender_email" class="form-control" id="exampleInputEmail1"
                                   placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label>Subject :</label>
                            <input type="text" name="subject" class="form-control" id="exampleInputEmail1"
                                   placeholder="Your Subject"/>
                        </div>
                        <div class="form-group">
                            <label>Message :</label>
                            <textarea name="message" class="form-control" id="exampleInputEmail1"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Attachment File : </label>
                            <input type="file" name="my_file"/>
                        </div>
                        <label>
                            <input type="submit" name="button" value="Send Mail" class="btn btn-primary"/></label>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
@endsection