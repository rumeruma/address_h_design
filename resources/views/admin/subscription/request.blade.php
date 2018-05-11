@extends('admin.layouts.page')

@section('content')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="title">Inactive Subscriptions</div>
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

            <table id="posts" class="table is-bordered">
                <thead class="thead">
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-2">Business Name</th>
                    <th class="col-md-1">Business Type</th>
                    <th class="col-md-1">Package</th>
                    <th class="col-md-2">User</th>
                    <th class="col-md-2">Expiry Date</th>
                    <th class="col-md-1">Bkash Token</th>
                    <th class="col-md-2">Action</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection


@section('scripts')

    <script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var subsTable = $('#posts').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "{{ route('abcd.subscription', ['0']) }}",
                "columns": [
                    {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                    {data: 'business', name: 'business'},
                    {data: 'type', name: 'type'},
                    {data: 'title', name: 'title'},
                    {data: 'email', name: 'email'},
                    {data: 'expiry', name: 'expiry'},
                    {data: 'paymentid', name: 'paymentid'},
                    {data: 'operations', name: 'operations'},
                ]
            }); // data table end

            $('#posts').on('click', 'button.do-ss', function () {
                var id = $(this).attr("data-id");
                $.ajax({
                    method: "POST",
                    url: "{{ route('subscription.activation') }}",
                    data: {subId: id},
                    success: function (data) {
                        swal({
                            title: "Activating Subscription",
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
                                'Has been updated successfully',
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
