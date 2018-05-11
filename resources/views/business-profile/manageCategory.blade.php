@extends('admin.layouts.page')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">Category Tree <a href="{{ route('business.category', ['manage']) }}" class="button is-primary is-small is-pulled-right">Manage Category</a></div>

            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {!!  session('status') !!}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">

                        <br>

                        <ul id="tree1">

                            @foreach($categories as $category)

                                <li>

                                    {{ $category->title }}

                                    @if(count($category->childs))

                                        @include('business-profile.manageChild',['childs' => $category->childs])

                                    @endif

                                </li>

                            @endforeach

                        </ul>

                    </div>

                    <div class="col-md-6">

                        <h3>Add New Category</h3>


                        {!! Form::open(['route'=>'add.business.category']) !!}


                        @if ($message = Session::get('success'))

                            <div class="alert alert-success alert-block">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ $message }}</strong>

                            </div>

                        @endif


                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                            {!! Form::label('Title:') !!}

                            {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}

                            <span class="text-danger">{{ $errors->first('title') }}</span>

                        </div>


                        <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">

                            {!! Form::label('Category:') !!}


                            <select name="parent_id" class="form-control" placeholder="Select Category">
                                <option value="">Select Parent</option>
                                @if($allCategories)
                                    @foreach($allCategories as $a_cat)
                                        <option value="{{ $a_cat->id }}">{{ $a_cat->title }}</option>
                                    @endforeach
                                @endif
                            </select>


                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>

                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Add New</button>
                        </div>


                        {!! Form::close() !!}


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.fn.extend({

            treed: function (o) {


                var openedClass = 'glyphicon-minus-sign';

                var closedClass = 'glyphicon-plus-sign';


                if (typeof o != 'undefined') {

                    if (typeof o.openedClass != 'undefined') {

                        openedClass = o.openedClass;

                    }

                    if (typeof o.closedClass != 'undefined') {

                        closedClass = o.closedClass;

                    }

                }
                ;


                /* initialize each of the top levels */

                var tree = $(this);

                tree.addClass("tree");

                tree.find('li').has("ul").each(function () {

                    var branch = $(this);

                    branch.prepend("");

                    branch.addClass('branch');

                    branch.on('click', function (e) {

                        if (this == e.target) {

                            var icon = $(this).children('i:first');

                            icon.toggleClass(openedClass + " " + closedClass);

                            $(this).children().children().toggle();

                        }

                    })

                    branch.children().children().toggle();

                });

                /* fire event from the dynamically added icon */

                tree.find('.branch .indicator').each(function () {

                    $(this).on('click', function () {

                        $(this).closest('li').click();

                    });

                });

                /* fire event to open branch if the li contains an anchor instead of text */

                tree.find('.branch>a').each(function () {

                    $(this).on('click', function (e) {

                        $(this).closest('li').click();

                        e.preventDefault();

                    });

                });

                /* fire event to open branch if the li contains a button instead of text */

                tree.find('.branch>button').each(function () {

                    $(this).on('click', function (e) {

                        $(this).closest('li').click();

                        e.preventDefault();

                    });

                });

            }

        });

        /* Initialization of treeviews */

        $('#tree1').treed();
    </script>
@endsection
@section('styles')
    <style>
        .tree, .tree ul {

            margin: 0;

            padding: 0;

            list-style: none

        }

        .tree ul {

            margin-left: 1em;

            position: relative

        }

        .tree ul ul {

            margin-left: .5em

        }

        .tree ul:before {

            content: "";

            display: block;

            width: 0;

            position: absolute;

            top: 0;

            bottom: 0;

            left: 0;

            border-left: 1px solid

        }

        .tree li {

            margin: 0;

            padding: 0 1em;

            line-height: 2em;

            color: #369;

            font-weight: 700;

            position: relative

        }

        .tree ul li:before {

            content: "";

            display: block;

            width: 10px;

            height: 0;

            border-top: 1px solid;

            margin-top: -1px;

            position: absolute;

            top: 1em;

            left: 0

        }

        .tree ul li:last-child:before {

            background: #fff;

            height: auto;

            top: 1em;

            bottom: 0

        }

        .indicator {

            margin-right: 5px;

        }

        .tree li a {

            text-decoration: none;

            color: #369;

        }

        .tree li button, .tree li button:active, .tree li button:focus {

            text-decoration: none;

            color: #369;

            border: none;

            background: transparent;

            margin: 0px 0px 0px 0px;

            padding: 0px 0px 0px 0px;

            outline: 0;

        }
    </style>
@endsection