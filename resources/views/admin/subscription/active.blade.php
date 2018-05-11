@extends('admin.layouts.page')

@section('content')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="title">Active Subscriptions</div>
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
                    <th class="col-md-1">Package </th>
                    <th class="col-md-2">User </th>
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
            $('#posts').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": "{{ route('abcd.subscription', ['1']) }}",
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
            });

            console.log('cxc')
        });
    </script>
@endsection

@section('styles')
    <style>
        .hide-btn{ display: none; }
    </style>

@endsection