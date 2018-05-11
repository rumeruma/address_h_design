@extends('admin.layouts.page')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">Manage Category
                <a href="{{ route('business.category') }}"
                   class="button is-primary is-small is-pulled-right">
                    Add Category</a>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select-basecat">Base Categories</label>
                            <select id="select-basecat" class="form-control cat-sel">
                                <option>select</option>
                                @foreach($categories as $bc)
                                    <option data-edt="{{ route('edit.business.category', [$bc->id]) }}"
                                            data-del="{{ route('delete.business.category', [$bc->id]) }}"
                                            value="{{ $bc->id }}">{{ $bc->title }}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="form-group">
                            <label for="select-cat">Child Categories</label>
                            <select id="select-cat" class="form-control cat-sel">
                                <option>select</option>
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->title }}">
                                        @if(count($category->childs))
                                            @include('business-profile.dumpChild',['childs' => $category->childs])
                                            @foreach($category->childs as $child)
                                                <option data-edt="{{ route('edit.business.category', [$child->id]) }}"
                                                        data-del="{{ route('delete.business.category', [$child->id]) }}"
                                                        value="{{ $child->id }}">{{ $child->title }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach

                            </select>

                        </div>

                    </div>
                    <div class="col-md-6">
                        @if ($errors->has('title'))
                            <span class="help-block">
                               <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <br>
                        <div class="panel panel-primary">
                            <div id="catInfo" class="panel-heading">
                                <span></span>

                                <a class="button del is-danger is-small is-pulled-right"><i class="fa fa-trash"></i></a>&nbsp;
                                <a class="button edt is-info is-small is-pulled-right"><i
                                            class="fa fa-pencil-square"></i></a>
                            </div>
                            <div id="catForm" class="panel-body">
                                <form id="deleteForm" method="post" action="">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <br>
                                <form id="editForm" method="post" action="">
                                    <div class="field is-grouped">
                                        <p class="control is-expanded">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input id="name" type="text" class="input" name="title" >
                                        </p>
                                        <p class="control">
                                            <button class="button is-info">
                                                Save
                                            </button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function () {
            $('select.cat-sel').on('change', function () {
                var id = this.value;
                var name = $(this).find("option:selected").text();
                var deleteurl = $(this).find("option:selected").attr('data-del');
                var editurl = $(this).find("option:selected").attr('data-edt');

                if (name != "select") {
                    $('#catInfo span').html(name);
                    $('#catInfo').show();
                    $('#name').val(name);
                    $('#cat_id').val(id);
                    $('#catForm').hide();
                    $('#deleteForm').attr('action', deleteurl);
                    $('#editForm').attr('action', editurl);
                } else {
                    swal(
                        'Opps!',
                        'This is not a valid category.',
                        'warning'
                    )
                }
            });

            $('#catInfo .edt').on('click', function () {
                $('#catForm').show();
            });


            $('#catInfo .del').on('click', function () {


                swal({
                    title: 'Are you sure?',
                    text: "remove category \"" + $('#name').val() + "\" permanently?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                    if (result.value) {
                        $('#deleteForm').submit();
                        swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                });

            });


        });


    </script>
@endsection
@section('styles')
    <style>
        #catInfo, #catForm {
            display: none;
        }
    </style>
@endsection