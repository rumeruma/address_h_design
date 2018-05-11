@extends('admin.layouts.page')

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/vendors/menu-maker/bs-iconpicker/css/bootstrap-iconpicker.min.css') }}"
          rel="stylesheet">
    <style>
        #editor {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select A Menu</label>
                    <select class="form-control form-control-lg" id="selectMenu">

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
                    Add A Menu
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="false"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add A Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('menu.store') }}" method="post" id="storeMenu">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="mneu-name" class="form-control-label">Name:</label>
                                        <input type="text" class="form-control" id="menu-name" name="menu-name">
                                        <div class="invalid-feedback menu-name">dss</div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="createMenu" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-6">

                <div id="editor" class="panel panel-primary">
                    <div class="panel-heading">Edit item</div>
                    <div class="panel-body">
                        <form id="frmEdit" class="form-horizontal">
                            <div class="form-group">
                                <label for="text" class="col-sm-2 control-label">Text</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text"
                                               placeholder="Text">
                                        <div class="input-group-btn">
                                            <button type="button" id="myEditor_icon" class="btn btn-default"
                                                    data-iconset="fontawesome"></button>
                                        </div>
                                        <input type="hidden" name="icon" class="item-menu">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="href" class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control item-menu" id="href" name="href"
                                           placeholder="URL">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="target" class="col-sm-2 control-label">Target</label>
                                <div class="col-sm-10">
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Tooltip</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control item-menu" id="title"
                                           placeholder="Tooltip">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i
                                    class="fa fa-refresh"></i>
                            Update
                        </button>
                        <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Add
                        </button>
                        <button type="button" id="btnCancel" class="btn btn-danger"><i class="fa fa-close"></i> Cancel
                        </button>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Select item</div>
                    <div class="panel-body">
                        <ul id="menusource" class="list-group">
                            @foreach($post as $p)
                                <li class="list-group-item" data-name="{{ $p->name }}">{{ $p->title }}</li>
                            @endforeach
                                <li class="list-group-item" data-name="360-career">Career</li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <button type="button" id="btnAddCustom" class="btn btn-info"><i class="fa fa-plus"></i> Add A
                            Custom Item
                        </button>
                    </div>
                </div>


            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix"><h5 class="pull-left">Menu</h5>
                        <div class="pull-right">
                            <button id="btnReload" type="button" class="btn btn-default">
                                <i class="glyphicon glyphicon-triangle-right"></i> Load Data
                            </button>
                        </div>
                    </div>
                    <div class="panel-body" id="cont">
                        <ul id="myEditor" class="sortableLists list-group">
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <button id="btnOut" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>
                        Save
                    </button>
                </div>
                <div class="form-group">
                    <textarea id="out" class="form-control" cols="50" rows="10" name="out"></textarea>
                </div>
            </div>

        </div>
        <hr>

    </div>
@endsection

@section('scripts')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin/vendors/menu-maker/jquery-menu-editor.js') }}"></script>
    <script src="{{ asset('admin/vendors/menu-maker/bs-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/menu-maker/bs-iconpicker/js/bootstrap-iconpicker.js') }}"></script>
    <script>
        jQuery(document).ready(function () {

            var menufucker = new MenuFucker('selectMenu');
            // MENU EDITOR



            var strjson = [];
            var iconPickerOpt = {cols: 5, searchText: "Buscar...", labelHeader: '{0} de {1} Pags.', footer: false};
            var options = {
                hintCss: {'border': '1px dashed #13981D'},
                placeholderCss: {'background-color': 'gray'},
                opener: {
                    as: 'html',
                    close: '<i class="fa fa-minus"></i>',
                    open: '<i class="fa fa-plus"></i>',
                    openerCss: {'margin-right': '10px'},
                    openerClass: 'btn btn-success btn-xs'
                }
            };
            var editor = new MenuEditor('myEditor', {
                listOptions: options,
                iconPicker: iconPickerOpt,
                labelEdit: 'Edit'
            });
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));

            $('#btnReload').on('click', function () {
                editor.setData(strjson);
            });

            // $('#btnOut').on('click', function () {
            //     var str = editor.getString();
            //     $("#out").text(str);
            // });

            $("#btnUpdate").click(function () {
                editor.update();
            });
            $('#btnAdd').click(function () {
                editor.add();
                $('#editor').hide("slow");
            });

            $('#menusource li').on('click', function () {
                var content = $(this).html();
                var slug = $(this).attr('data-name');
                $('#text').val(content);
                $('#href').val(slug);
                $('#editor').show("slow");
            });

            $('#btnCancel').click(function () {
                $('#editor').hide("slow");
                $('#text').val("");
                $('#href').val("");
            });

            $('#btnAddCustom').click(function () {
                $('#editor').show("slow");
                $('#text').val("");
                $('#href').val("");
            });


            // MENU SAVING FUNCTIONS

            $('#createMenu').on('click', function () {
                $.ajax({
                    method: "POST",
                    url: "{{ route('menu.store') }}",
                    data: {name: $('#menu-name').val()},
                    success: function () {
                        $('#myModal').modal('hide');
                        swal("Menu Saved", "now you can eidt this menu item by selecting it", 'success');
                        $('.invalid-feedback.menu-name').html("");
                        $('#menu-name').val("");
                        if ($('#menu-name').hasClass('is-invalid')) {
                            $('#menu-name').removeClass('is-invalid');
                        }

                    },
                    error: function (msg) {
                        if (msg.status === 422) {

                            $.each(msg.responseJSON, function (key, value) {
                                $('.invalid-feedback.menu-name').html(value[0]).show();
                                $('#menu-name').addClass('is-invalid');

                            });
                        }
                    }
                }).done(function () {
                    menufucker.initselect();
                });
            });

            $('#myModal .modal-dialog').css("margin-top", 200);

            // INIT SELECT
            menufucker.initselect();
            menufucker.changeSelect(strjson,editor.setData);

            // MENU SAVING FUNCTIONS END

            // MENU UPDATING FUNCTIONS

            $('#btnOut').on('click', function () {
                $.ajax({
                    method: "PUT",
                    url: "{{ route('menu.update') }}",
                    data: {name: $('#selectMenu').val(),content: editor.getFuck()},
                    success: function () {
                        $('#myModal').modal('hide');
                        swal("Menu Saved", "", 'success');
                        $('.invalid-feedback.select-menu').html("");

                        if ($('#menu-name').hasClass('is-invalid')) {
                            $('#menu-name').removeClass('is-invalid');
                        }

                    },
                    error: function (msg) {
                        if (msg.status === 422) {

                            $.each(msg.responseJSON, function (key, value) {
                                $('.invalid-feedback.select-menu').html(value[0]).show();
                                $('#selectMenu').addClass('is-invalid');

                            });
                        }
                    }
                }).done(function () {
                    // menufucker.initselect();
                });
            });


            // content: editor.getFuck();

            $('#cont').on('click', '.btnEdit', function(){ $('#editor').show("slow"); });

        });

        function MenuFucker(selector) {
            var $select = $("#" + selector);
            var menuData = [];
            this.initselect = function initSelect() {
                $.getJSON("{{ route('menu.all') }}", function (data) {
                    var items = ['<option>Select a Menu</option>'];
                    $.each(data, function (key, val) {
                        items.push('<option value="' + val['name'] + '">' + val['title'] + '</option>');
                        menuData[val['name']] = val['content'];
                    });
                    $($select).html("");
                    $($select).append(items.join(""));
                    // console.log(items.join(""));
                });
            }
            this.changeSelect = function changeselect(loadto, dhonBack){
                $($select).on('change', function () {
                    loadto = JSON.stringify(menuData[$(this).val()]);
                    dhonBack(JSON.stringify(menuData[$(this).val()]));
                });

            }
        }

    </script>

@endsection