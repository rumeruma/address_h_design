@extends('admin.layouts.page')

@section('content')
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <div class="title">Social Links</div>
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

    <div id="opt" class="columns is-multiline">
        <div class="column is-12">

            <div class="box">
                <opt-social-links urlz="{{ route('update.option') }}" socials="{{ json_encode($options['social-links']) }}"></opt-social-links>
            </div>

        </div>
    </div>
@endsection


@section('scripts')

    <script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {


        });
    </script>
@endsection
