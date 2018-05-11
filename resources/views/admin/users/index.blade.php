@extends('admin.layouts.page')

@section('content')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="title">Admin User Controll</div>
            </div>
        </div>
        <div class="level-right">
            <div class="level-item">
                <button type="button" class="button is-small">
                    {{ date('M d Y') }}
                </button>
            </div>
        </div>
    </div>

    <div class="columns is-multiline">
        <div class="column is-12">

            <div class="box">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Create User</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input id="name" class="input" type="text" placeholder="Name">
                                <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input id="email" class="input" type="email" placeholder="Email">
                                <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                            </p>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button id="create" type="button" class="button is-primary">
                                    Create
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="columns is-multiline">
        <div class="column is-12">
            <div class="box">
                <table id="usersDhon" class="table is-bordered">
                    <thead class="thead">
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">User Name</th>
                        <th class="col-md-1">Email</th>
                        <th class="col-md-1">Role</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
@endsection


@section('scripts')

    <script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var subsTable = $('#usersDhon').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "{{ route('abcd.users') }}",
                "columns": [
                    {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'status', name: 'status'},
                    {data: 'operations', name: 'operations'},
                ]
            }); // data table end

            $('#create').on('click', function () {
                var name = $('#name').val();
                var email = $('#email').val();
                $.ajax({
                    method: "POST",
                    url: "{{ route('user.store') }}",
                    data: {name: name, email: email},
                    success: function (data) {
                        swal({
                            title: "Creating Reporter User",
                            text: 'please wait',
                            timer: 5000,
                            onOpen: function () {
                                swal.showLoading()
                            }
                        }).then(function (result) {
                            if (result.dismiss === swal.DismissReason.timer) {
                                subsTable.ajax.reload(null, false)
                            }

                            swal(
                                data.success,
                                'Has been created successfully',
                                'success'
                            )
                        });
                    },
                    error: function (msg) {
                        var errorMsg = "";
                        if (msg.status === 422) {
                            $.each(msg.responseJSON, function (key, value) {
                                errorMsg += '<li class="text-danger">' + value + '</li>';
                            });
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                html: '<ol>' + errorMsg + '</ol>',
                            });
                        }
                    }
                });
            });


            $('#usersDhon').on('click', 'button.pl', function () {
                var id = $(this).attr("data-id");
                var status = 0;
                if ($(this).hasClass('lock')) {
                    status = 1;
                }
                else if ($(this).hasClass('unlock')) {
                    status = 0;
                }
                $.ajax({
                    method: "POST",
                    url: "{{ route('user.locker') }}",
                    data: {id: id, status: status},
                    success: function (data) {
                        swal({
                            title: "Updating User",
                            text: 'please wait',
                            timer: 5000,
                            onOpen: function () {
                                swal.showLoading()
                            }
                        }).then(function (result) {
                            if (result.dismiss === swal.DismissReason.timer) {
                                subsTable.ajax.reload(null, false)
                            }

                            swal(
                                data.success,
                                'Has Been Locked Successfully',
                                'success'
                            )
                        });
                    },
                    error: function (msg) {
                        var errorMsg = "";
                        if (msg.status === 422) {
                            $.each(msg.responseJSON, function (key, value) {
                                errorMsg += value;
                            });
                            swal(errorMsg);
                        }
                    }
                });
            });

        }); //Doc ready
    </script>
@endsection
