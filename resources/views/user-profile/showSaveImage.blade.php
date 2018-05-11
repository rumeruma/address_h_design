@extends('layouts.page')

@section('content')
    <br>
    <div class="container">
        <div class="row">

            <div id="user" class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Public Profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                @if(count($errors))
                                    @foreach($errors->all() as $error)
                                        <span class="text-danger">{{ $error }}</span>
                                    @endforeach
                                @endif

                                <custom-vue-avatar :user="{{ $profile }}"></custom-vue-avatar>
                            </div>
                            <div class="col-md-9">
                                <user-detail :detail="{{ $profile }}"></user-detail>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Company Profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if($packages)
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Package Name</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Expiry</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($packages as $key=>$package)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>{{ $package->title }}</td>
                                                <td>{{ $package->business }}</td>
                                                <td>{!!  $package->active == 0 ? '<span class="text-danger">Inactive<span>' : '<span class="text-success">Active<span>'  !!}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$package->expiry)->format('d M Y') }}</td>
                                                <td>{!!  $package->post_id == null ? 'Need Activation' : '<a class="btn btn-xs btn-info" href="'.route('my-business.edit',[$package->id]).'">Edit<a>'  !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <a class="btn btn-default" href="{{ url('/#pricing-item-block') }}">purchase a slot</a>

                                @else
                                    <h1 class="text-center">No Company Profile Created</h1>
                                    <h3 class="text-center">you need to purchase a <a
                                                href="{{ url('/#pricing-item-block') }}">slot</a> first</h3>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
